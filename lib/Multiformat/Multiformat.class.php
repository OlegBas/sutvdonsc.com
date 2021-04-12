<?php
/**
 * Created by PhpStorm.
 * User: Danila
 * Date: 22.12.14
 * Time: 19:15
 */


class Multiformat {

    public $structure;
    public $width;
    public $height;
    public $out;
    public $bgcolor;
    public $zoom=1;



    public $default = array
    (
        'text' => array
        (
            'text'      => '',
            'font-size' => 10,
            'font-name' =>'arial',
            'position'  => array(0, 0, 'px'),
            'color'     => array(0,0,0),
            'align'     => 'center',
            'width'     => array(200, 'px')
        ),
        'image' => array(

            'file' => '',
            'width'=>0,
            'height'=>0,
            'position'  => array(0, 0, 'px'),
        )



    );

    public $fonts = array
    (
        'arial' => array('file'=>'fonts/arial.ttf', 'cache'=>false)

    );

    function __construct($structure, $width, $height, $bgcolor = '#ffffff')
    {
        $this->structure    = $structure;
        $this->width  = $width;
        $this->height = $height;
        $this->bgcolor = $bgcolor;


    }


    function get()
    {

    }

    /* ������� �� ��������� (�������� ��� ����������� ��������) */
    function create()
    {
        $this->out = imagecreatetruecolor($this->width*$this->zoom, $this->height*$this->zoom);

        $color = $this->image_color($this->bgcolor);

        imagefilledrectangle($this->out, 0, 0, $this->width*$this->zoom, $this->height*$this->zoom, $color);
        //imageSaveAlpha($this->out, true);

      // $trans_colour = imagecolorallocatealpha($this->out, 0, 0, 0, 127);
       //imagefill($this->out, 255, 255, 255);
    }

    function parser()
    {

        foreach($this->structure as $key=>$val)
        {
            $val     =  array_merge($this->default[$val['type']], $val);

            switch($val['type'])
            {
                case "text": $this->text($val,  $key);break;
                case "image" : $this->image($val,  $key);break;

            }
        }
    }

    function text($e, $id='')
    {
        if(!isset($this->fonts[$e['font-name']])) return 0;

        $font_file  = $this->fonts[$e['font-name']]['file'];
        $font_cache = $this->fonts[$e['font-name']]['cache'];
        $font_size =  $e['font-size']*$this->zoom;
        $width = $e['width'][0]*$this->zoom;
        $align = (isset($e['align'])) ? $e['align'] : 'left';

        $margin = 0*$this->zoom;
        $color = $e['color'];

        //$text = self::win_uni($e['text']);
        $text = $e['text'];
/*
        if($font_cache) $font = $font_cache;
        else{
            $font = imageLoadFont($font_file);
            $this->fonts[$e['font-name']]['cache'] = $font;
        }

        if($e['position'][2] == 'mm')
        {
            $x =  floor($e['position'][0]/0.264583333333334);
            $y =  floor($e['position'][1]/0.264583333333334);
        }
        else
        {
            $x =  $e['position'][0];
            $y =  $e['position'][1];
        }
        */
        $x =  $e['position'][0]*$this->zoom;
        $y =  $e['position'][1]*$this->zoom;
        $this->pos($x, $y, $e['position'][2]);
       // $color = imageColorAllocate($this->out, $color[0], $color[1], $color[2]);//$this->image_color($color);

       //imageTtfText($this->out, $font_size, 0, $x, $y, $color,$font_file,  $text);
       $this->image_text($text, $font_file, $font_size, $width,$x,$y,  $margin, $color, $align);

    }

    public function image($e)
    {
        $file = $e['file'];

        $type_img   = $this->imageType( $file );
        $gd_info 	  = gd_info();

        $size_img = getimagesize($file);

        $width  =  $size_img[0];
        $height =  $size_img[1];

        if( $type_img == 3 AND $gd_info['PNG Support'] == 1 )
        {
            $img= imagecreatefromPNG( $file );
        }
        elseif( $type_img == 2 AND ($gd_info['JPEG Support'] == 1 || $gd_info['JPG Support'] == 1) )
        {
            $img= imagecreatefromJPEG( $file );
        }
        elseif( $type_img == 1 AND $gd_info['GIF Create Support'] == 1  )
        {
            $img 	 = imagecreatefromGIF( $file );
        }

        $x =  $e['position'][0];
        $y =  $e['position'][1];


        $this->pos($x, $y, $e['position'][2]);

        imageCopyResampled ($this->out, $img, $x, $y,0, 0, $e['width'] * $this->zoom, $e['height'] * $this->zoom,
            $width, $height);





    }

    function pos(&$x, &$y, $u='pix')
    {


        if($u == 'mm')
        {
            $x =  floor($x/0.264583333333334);
            $y =  floor($y/0.264583333333334);
        }

    }

    function imageType( $img_path ){

        if( function_exists( 'exif_imagetype' ) ){
            return exif_imagetype( $img_path );
        }
        else{
            $arr_from_img = getimagesize ( $img_path );
            return $arr_from_img['2'];
        }
    }



    function save()
    {

    }

    static function win_uni ($in) {


        $in = iconv('UTF-8', 'windows-1251', $in);

        $in = convert_cyr_string($in ,"w","i");


                $out = "";
                for ($i=0; $i < strlen($in); $i++) {
                    $char = ord($in[$i]);
                    $out .= ($char > 175)?"&#".(1040+($char-176)).";":$in[$i];

                }
                return $out;



    }


    function image_text($text, $font, $font_size, $width, $x, $y, $margin, $color, $align = 'left')
    {

        $text_a = explode(' ', $text);
        $text_new = '';
        foreach($text_a as $word){

            $box = imagettfbbox($font_size, 0, $font, $text_new.' '.$word);

            if($box[2] > $width - $margin*2){
                $text_new .= "\n".$word;
            } else {
                $text_new .= " ".$word;
            }
        }

        $text_new = trim($text_new);

        $box = imagettfbbox($font_size, 0, $font, $text_new);

        $height = $box[1] + $font_size + $margin * 2;
        $col = $this->image_color($color);

        $xText = $x+$margin;
        $yText = $y+$font_size+$margin;

        if ($align == "center") {
            $center = round($width/2); //центр изображения
            $xText = $center-round(($box[2]-$box[0])/2)+$margin;
        } elseif ($align == "right") {
            $xText = $width-$box[2]-$box[0]-$margin;
        }



        imagettftext($this->out, $font_size, 0, $xText, $yText, $col, $font, $text_new);
    }

    function image_color($color)
    {

        if(!is_array($color))
        {
            $red   = 0;
            $green = 0;
            $blue  = 0;

            sscanf($color, "%2x%2x%2x", $red, $green, $blue);

            return imageColorAllocate($this->out, $red, $green, $blue);
        }
        else return imageColorAllocate($this->out, $color[0], $color[1], $color[2]);

    }

}


class jpeg extends multiformat
{


    function get()
    {
        $this->create();
        $this->parser();

        header('Content-type: image/jpg');
        imagejpeg($this->out, null, 100);

    }

    function save($file)
    {
        $this->create();
        $this->parser();

        imagejpeg($this->out, $file, 100);
    }
}

class html extends multiformat
{
    function create()
    {


        $this->out = '<div id="fsd" style="width: '.$this->width.
                        'px; height:'.$this->height.
                        'px; background-color:'.$this->color($this->bgcolor).
                        '; position:relative ">';
    }

    function get()
    {
        $this->create();
        $this->parser();
        $this->out .= '</div>';
        return $this->out;
    }

    function save($file)
    {

    }

    function text($e, $id='')
    {
        $font = "arial";

        if(isset($this->fonts[$e['font-name']])) $font = $e['font-name'];

        $font_size =  $e['font-size'];
        $width = $e['width'][0];

        $margin = 0;
        $color = $e['color'];

        $text = str_replace("\n",'<br />', $e['text'] );

        $x =  $e['position'][0];
        $y =  $e['position'][1];
        $this->pos($x, $y, $e['position'][2]);

        $style  = '';
        $style .= 'font-size:'.$font_size.'pt;';
        $style .= 'font-family:'.$font.';';
        $style .= 'color:'.$this->color($color).';';
        $style .= 'position:absolute;';
        $style .= 'left:'.$x.'px;';
        $style .= 'top:'.$y.'px;';
        $style .= 'display:block;';
        $style .= 'text-align:left;';
        $style .= 'width:'.$width.'px;';
        $style .= 'margin:'.$margin.'px;';
        //$style .= 'border:1px solid red;';

        $this->out .= '<p id="'.$id.'" style="'.$style.'">'.$text.'</p>';

    }

    public function image($e, $id)
    {
        $x =  $e['position'][0];
        $y =  $e['position'][1];
        $this->pos($x, $y, $e['position'][2]);

        $file = $e['file'];
        $width = $e['width']+1;
        $height = $e['height']+1;

        $style  = '';

        $style .= 'position:absolute;';
        $style .= 'left:'.$x.'px;';
        $style .= 'top:'.$y.'px;';
        $style .= 'display:block;';
        $style .= 'width:'.$width.'px;';
        $style .= 'height:'.$height.'px;';
        $this->out .= '<img src="'.$file.'" id="'.$id.'" style="'.$style.'" />';
    }

    function color($color)
    {

        if(is_array($color))
        {
            return 'rgb('.$color[0].','.$color[1].', '.$color[2].')';
        }
        return $color;

    }
}
