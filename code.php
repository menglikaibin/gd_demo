<?php
class ValidateCode
{
    private $charset = "abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789"; //随机数
    private $code; //验证码
    private $codelen = 4; //验证码长度
    private $width = 100; //宽度
    private $height = 37; //高度
    private $img; //图形资源句柄
    private $font; //指定的字体
    private $fontsize = 28; //指定字体大小
    private $fontcolor; //指定字体颜色

    public function __construct($path)
    {
        $this->font = $path;
    }

    //生成背景颜色
    private function createBg()
    {
        $this->img = imagecreatetruecolor($this->width, $this->height);
        $color = imagecolorallocate($this->img, 255, 255, 255);
        imagefill($this->img, 0, 0, $color);
    }

    //生成验证码
    private function createCode()
    {
        $len = strlen($this->charset) - 1;
        for ($i = 0; $i < $this->codelen; $i++) {
            $this->code .= $this->charset[mt_rand(0, $len)];
        }
    }

    //生成文字
    private function createFont()
    {
        $x = $this->width / $this->codelen;
        for ($i = 0; $i < $this->codelen; $i++) {
            $this->fontcolor = imagecolorallocate($this->img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));

//            echo $this->fontcolor; echo "<br>";
            echo $this->code[$i];

            imagettftext($this->img, $this->fontsize, mt_rand(-30, 30), $x * $i + mt_rand(1, 5), $this->height / 1.4, $this->fontcolor, $this->font, $this->code[$i]);
        }
    }

    //生成线条雪花
    private function createLine()
    {
        //线条
        for ($i=0;$i<6;$i++) {
            $color = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
            imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$color);
        }
        //雪花
        for ($i=0;$i<100;$i++) {
            $color = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
            imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand(0,$this->height),'*',$color);
        }
    }

    //输出
    private function outPut($path)
    {
//        header('Content-type:image/png');
        imagepng($this->img, $path);
        imagedestroy($this->img);
    }

    //对外生成
    public function doimg()
    {
        $this->createBg();
        $this->createCode();
        $this->createFont();

        $this->createLine();

        $name = time();

        $path = dirname(__FILE__) . "/img/" . $name . ".png";
//        print_r($path);die;

        $this->outPut($path);
    }
}


$GD = new ValidateCode(dirname(__FILE__) . '/captcha.ttf');
$GD->doimg();



