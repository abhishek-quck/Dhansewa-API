<?php

use Dompdf\Dompdf;
use Illuminate\Support\Facades\Log;

function generatePdf($html, $aOptions=null, $php = true, $landscape = false)
{
    $defaultOptions = ['isRemoteEnabled' => true];
    if ($aOptions !== false)
    {
        if ($aOptions === null) $aOptions=$defaultOptions;
        $options= new \Dompdf\Options();
        foreach ($aOptions as $option => $value)
        {
            $options->set($option, $value);
        }
        $options->setIsPhpEnabled($php);
        $dompdf = new Dompdf($options);
    }
    else
    {
        $dompdf = new Dompdf();
    }
    $dompdf->loadHtml($html);
    if($landscape){
        $dompdf->setPaper('A4', 'landscape');
    }else{
        $dompdf->setPaper('A4', 'portrait');
    }
    $dompdf->render();
    return $dompdf;
}

function generate($file)
{
   try {
    $hash=hash_file('sha512', $file);
    $record=[];
    $files=glob(storage_path('imagecache/'.$hash.'-*.jpg'));
    usort($files, function ($a, $b) {
        $numoffset=max(substr_count($a, '-'), substr_count($b, '-')) ; $expectedlen=$numoffset+ 2;
        $arr_a = preg_split('/[-\.]/', $a );
        $arr_b = preg_split('/[-\.]/', $b );
        if (count($arr_a) < $expectedlen || count($arr_b) < $expectedlen || $arr_a[$numoffset] == $arr_b[$numoffset]) return 0;
        return ($arr_a[$numoffset] < $arr_b[$numoffset]) ? -1 : 1;
    });
    foreach ($files as $file)
    {
        if (preg_match('~storage/imagecache/'.$hash.'-([0-9]+).jpg~', $file, $matches) === 1)
        {
            $record[]=(object) ['sn' => $matches[1]];
        }
    }

    if (count($record) == 0) // No attachment? No problem!
    {
        set_time_limit(0); // Big files WILL take longer than thirty seconds.
        if (strpos($file, 'data:application/pdf') === 0)
        {
            $newfile=tempnam(session_save_path(), 'conv');
            unlink($newfile);
            $contents=file_get_contents($file);
            if (strpos($contents, 'data:application/pdf;base64,') === 0)
            {
                throw new \Exception('A data URL header has somehow been included with the file contents. Please fix.');
            }
            file_put_contents($newfile.'.pdf', $contents);
            $file=$newfile.'.pdf';
        }
        $jpg=tempnam(session_save_path(), 'conv');
        unlink($jpg); // We don't actually need this file
        $im=new Imagick();
        $im->setResolution(300, 300);
        try {
            $im->readImage($file);
        } catch( \Exception $e ){
            Log::info('this is the exception you are looking for:-  '.$e->getMessage());
            return [false, $e];
        }
        $im->setCompression(Imagick::COMPRESSION_JPEG);
        $im->setCompressionQuality(100);
        $im->setImageFormat("jpg");
        $im->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
        $im->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);
        $im->setImageType(imagick::IMGTYPE_TRUECOLOR);

        if ($im->getNumberImages() > 1)
        {
            Log::info('no. of images is greater than 1 ');
            foreach ($im as $no => $page)
            {
                $newpage=new Imagick();
                $newpage->newPseudoImage($page->getImageWidth(), $page->getImageHeight(), 'canvas:white');
                $newpage->compositeImage($page, Imagick::COMPOSITE_ATOP, 0, 0);
                $newpage->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
                $newpage->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);
                $newpage->setImageType(imagick::IMGTYPE_TRUECOLOR);
                $newpage->setImageFormat("jpg");
                if ($page->getImageColorspace() == $newpage->getImageColorspace())
                {
                    $newpage->writeImage($jpg.'-'.$no.'.jpg');
                }
                else
                {
                    $page->writeImage($jpg.'-'.$no.'.jpg');
                }
            }
        }
        else
        {
            $im->writeImage($jpg.'.jpg');
        }
        unlink($file); // There's no server B.

        $seq=0;
        $newjpg='';
        while (file_exists($newjpg=sprintf('%s-%d.jpg', $jpg, $seq)) || file_exists($newjpg=$jpg.'.jpg'))
        {
            Log::info('file exists');
            rename($newjpg, storage_path('imagecache/'.$hash.'-'.$seq.'.jpg'));
            $record[]=(object) ['sn' => $seq];
            $seq++;
        }
        return [$hash, $record];
    }
    } catch ( \Throwable $e )
    {
        Log::info('Error :- ', array_merge(['message' =>$e->getMessage() ], $e->getTrace()));
    }
}

?>
