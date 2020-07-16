<?php

namespace App;
use App\Color;



class Styling
{
    protected $StyleEndHtml = "</span>";
    protected $StyleEndTag = "#StyleEndTag";
    protected $LiteBlueHtml;
    protected $LiteBlueTag = "#LiteBlueTag ";
    protected $BlueHtml;
    protected $BlueTag = "#BlueTag";
    protected $WarningHtml;
    protected $WarningTag = "#WarningTag";
    protected $MagentaHtml;
    protected $MagentaTag = "#MagentaTag";
    protected $LiteCyanHtml;
    protected $LiteCyanTag = "#LiteCyanTag";
    protected $CyanHtml;
    protected $CyanTag = "#CyanTag";
    protected $LiteGreyHtml;
    protected $LiteGreyTag = "#LiteGreyTag";
    protected $GreyHtml;
    protected $GreyTag = "#GreyTag";
    protected $SvrtyGoodHtml;
    protected $SvrtyGoodTag = "#SvrtyGoodTag";
    protected $SvrtyBestHtml;
    protected $SvrtyBestTag = "#SvrtyBestTag";
    protected $SvrtyLowHtml;
    protected $SvrtyLowTag = "#SvrtyLowTag";
    protected $SvrtyMediumHtml;
    protected $SvrtyMediumTag = "#SvrtyMediumTag";
    protected $SvrtyHighHtml;
    protected $SvrtyHighTag = "#SvrtyHighTag";
    protected $SvrtyCriticalHtml;
    protected $SvrtyCriticalTag = "#SvrtyCriticalTag";
    protected $HeadlineHtml = "<span style=\"text-decoration:underline;font-weight:bold;font-family: monospace;\">";
    protected $HeadlineTag = "#HeadlineTag";
    protected $ReverseHtml = "<span style=\"color:white;background-color:black;font-family: monospace;\">";
    protected $ReverseTag = "#ReverseTag";
    protected $ReverseBoldHtml = "<span style=\"color:white;background-color:black;font-weight:bold;font-family: monospace;\">";
    protected $ReverseBoldTag = "#ReverseBoldTag";
    protected $UnderlineHtml = "<span style=\"text-decoration:underlinefont-family: monospace;\">";
    protected $UnderlineTag = "#UnderlineTag";
    protected $LineThroughHtml = "<span style=\"text-decoration:line-throughfont-family: monospace;\">";
    protected $LineThroughTag = "#LineThroughTag";
    protected $ItalicHtml = "<span style=\"font-style:italicfont-family: monospace;\">";
    protected $ItalicTag = "#ItalicTag";
    protected $BoldHtml = "<span style=\"font-weight:bold;font-family: monospace;\">";
    protected $BoldTag = "#BoldTag";
    
    function __construct() {
        $LiteBlue = Color::where('name', 'LiteBlue' )->first()->color;
        $Blue = Color::where('name', 'Blue' )->first()->color;
        $Warning = Color::where('name', 'Warning' )->first()->color;
        $Magenta = Color::where('name', 'Magenta' )->first()->color;
        $LiteCyan = Color::where('name', 'LiteCyan' )->first()->color;
        $Cyan = Color::where('name', 'Cyan' )->first()->color;
        $LiteGrey = Color::where('name', 'LiteGrey' )->first()->color;
        $Grey = Color::where('name', 'Grey' )->first()->color;
        $SvrtyGood = Color::where('name', 'SvrtyGood' )->first()->color;
        $SvrtyBest = Color::where('name', 'SvrtyBest' )->first()->color;
        $SvrtyLow = Color::where('name', 'SvrtyLow' )->first()->color;
        $SvrtyMedium = Color::where('name', 'SvrtyMedium' )->first()->color;
        $SvrtyHigh = Color::where('name', 'SvrtyHigh' )->first()->color;
        $SvrtyCritical = Color::where('name', 'SvrtyCritical' )->first()->color;


        $this->LiteBlueHtml = join(["<span style=\"color:",$LiteBlue ,";font-family: monospace;\">"]);
        $this->BlueHtml = join(["<span style=\"color:",$Blue ,";font-weight:bold;font-family: monospace;\">"]);
        $this->WarningHtml = join(["<span style=\"color:",$Warning ,";font-family: monospace;\">"]);
        $this->MagentaHtml = join(["<span style=\"color:",$Magenta ,";font-weight:bold;font-family: monospace;\">"]);
        $this->LiteCyanHtml =join(["<span style=\"color:",$LiteCyan ,";font-family: monospace;\">"]); 
        $this->CyanHtml = join(["<span style=\"color:",$Cyan ,";font-weight:bold;font-family: monospace;\">"]);
        $this->LiteGreyHtml =join(["<span style=\"color:",$LiteGrey ,";font-family: monospace;\">"]); 
        $this->GreyHtml = join(["<span style=\"color:",$Grey ,";font-weight:bold;font-family: monospace;\">"]);
        $this->SvrtyGoodHtml =join(["<span style=\"color:",$SvrtyGood ,";font-family: monospace;\">"]); 
        $this->SvrtyBestHtml = join(["<span style=\"color:",$SvrtyBest ,";font-weight:bold;font-family: monospace;\">"]);
        $this->SvrtyLowHtml = join(["<span style=\"color:",$SvrtyLow ,";font-weight:bold;font-family: monospace;\">"]);
        $this->SvrtyMediumHtml =join(["<span style=\"color:",$SvrtyMedium ,";font-family: monospace;\">"]); 
        $this->SvrtyHighHtml = join(["<span style=\"color:",$SvrtyHigh ,";font-family: monospace;\">"]);
        $this->SvrtyCriticalHtml = join(["<span style=\"color:",$SvrtyCritical ,";font-weight:bold;font-family: monospace;\">"]);
    }
    public function cmdToTags($array){
        $array = str_replace("\033[m", $this->StyleEndTag, $array);
        $array = str_replace("\033[1m", $this->BoldTag, $array);  //Bold replace
        $array = str_replace("\033[0;34m", $this->LiteBlueTag , $array);  // Liteblue
        $array = str_replace("\033[1;34m", $this->BlueTag , $array); // Blue
        $array = str_replace("\033[0;35m", $this->WarningTag, $array);  // Warning
        $array = str_replace("\033[1;35m", $this->MagentaTag, $array);  //Magenta
        $array = str_replace("\033[0;36m", $this->LiteCyanTag, $array);  // LiteCyan
        $array = str_replace("\033[1;36m", $this->CyanTag, $array);  // cyan
        $array = str_replace("\033[0;37m", $this->LiteGreyTag, $array); //LiteGrey
        $array = str_replace("\033[1;30m", $this->GreyTag, $array);  // Grey
        $array = str_replace("\033[0;32m", $this->SvrtyGoodTag, $array);  //svrty_good
        $array = str_replace("\033[1;32m", $this->SvrtyBestTag, $array);  //svrty_best
        $array = str_replace("\033[1;33m", $this->SvrtyLowTag, $array);  //svrty_low
        $array = str_replace("\033[0;33m", $this->SvrtyMediumTag, $array);  //svrty_medium
        $array = str_replace("\033[0;31m", $this->SvrtyHighTag, $array);  //svrty_high
        $array = str_replace("\033[1;31m", $this->SvrtyCriticalTag, $array);  //svrty_critical
        $array = str_replace("\033[1m\033[4m", $this->HeadlineTag, $array);  //Headline
        $array = str_replace("\033[7m", $this->ReverseTag, $array);  //Reverse
        $array = str_replace("\033[7m\033[1m", $this->ReverseBoldTag, $array);  //reverse_bold
        $array = str_replace("\033[4m", $this->UnderlineTag, $array);  //underline
        $array = str_replace("\033[9m", $this->LineThroughTag, $array);  //strikethru
        $array = str_replace("\033[3m", $this->ItalicTag, $array);  //italic
        return $array;
    }


    public function TagsToHtml($array){
        $array = str_replace($this->StyleEndTag, $this->StyleEndHtml, $array);
        $array = str_replace($this->BoldTag, $this->BoldHtml, $array);  //Bold replace
        $array = str_replace($this->LiteBlueTag, $this->LiteBlueHtml, $array);  // Liteblue
        $array = str_replace($this->BlueTag, $this->BlueHtml, $array); // Blue
        $array = str_replace($this->WarningTag, $this->WarningHtml, $array);  // Warning
        $array = str_replace($this->MagentaTag, $this->MagentaHtml, $array);  //Magenta
        $array = str_replace($this->LiteCyanTag, $this->LiteCyanHtml, $array);  // LiteCyan
        $array = str_replace($this->CyanTag, $this->CyanHtml, $array);  // cyan
        $array = str_replace($this->LiteGreyTag, $this->LiteGreyHtml, $array); //LiteGrey
        $array = str_replace($this->GreyTag, $this->GreyHtml, $array);  // Grey
        $array = str_replace($this->SvrtyGoodTag, $this->SvrtyGoodHtml, $array);  //svrty_good
        $array = str_replace($this->SvrtyBestTag, $this->SvrtyBestHtml, $array);  //svrty_best
        $array = str_replace($this->SvrtyLowTag, $this->SvrtyLowHtml, $array);  //svrty_low
        $array = str_replace($this->SvrtyMediumTag, $this->SvrtyMediumHtml, $array);  //svrty_medium
        $array = str_replace($this->SvrtyHighTag, $this->SvrtyHighHtml, $array);  //svrty_high
        $array = str_replace($this->SvrtyCriticalTag, $this->SvrtyCriticalHtml, $array);  //svrty_critical
        $array = str_replace($this->HeadlineTag, $this->HeadlineHtml, $array);  //Headline
        $array = str_replace($this->ReverseTag, $this->ReverseHtml, $array);  //Reverse
        $array = str_replace($this->ReverseBoldTag, $this->ReverseBoldHtml, $array);  //reverse_bold
        $array = str_replace($this->UnderlineTag, $this->UnderlineHtml, $array);  //underline
        $array = str_replace($this->LineThroughTag, $this->LineThroughHtml, $array);  //strikethru
        $array = str_replace($this->ItalicTag, $this->ItalicHtml, $array);  //italic
        return $array;
    }
}
