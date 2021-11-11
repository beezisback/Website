<?php
//bbcode and smilies

function bbcode ($str) {
    //$str = htmlentities($str);

    $token = array(
                "'\[b\](.*?)\[/b\]'is",                                  
                '/\[i\](.*?)\[\/i\]/is',                                
                '/\[u\](.*?)\[\/u\]/is',                                
                '/\[url\=(.*?)\](.*?)\[\/url\]/is',                         
                '/\[url\](.*?)\[\/url\]/is',                             
                '/\[align\=(left|center|right)\](.*?)\[\/align\]/is',    
                '/\[img\](.*?)\[\/img\]/is',                            
                '/\[mail\=(.*?)\](.*?)\[\/mail\]/is',                    
                '/\[mail\](.*?)\[\/mail\]/is',                            
                '/\[font\=(.*?)\](.*?)\[\/font\]/is',                    
                '/\[size\=(.*?)\](.*?)\[\/size\]/is',                    
                '/\[color\=(.*?)\](.*?)\[\/color\]/is',   
                "':big_smile:'is",  
                "':cool:'is", 
                "':hmm:'is",
                "':lol:'is",  
                "':mad:'is",
                "':neutral:'is",
                "':roll:'is",
                "':sad:'is",
                "':smile:'is",
                "':tongue:'is",
                "':wink:'is",
                "':yikes:'is",  
                "':bhmm:'is",   
                "':bsmile:'is",   
                "':dsmile:'is",   
                "':blush:'is",   
                "':bunny:'is",   
                "':pumpkin:'is",  
                "':bull:'is", 
                );

    $tokenized = array(
                '<strong>$1</strong>',
                '<em>$1</em>',
                '<u>$1</u>',
				        '<a href="http://$1" target="BLANK">$2</a>',
				        '<a href="http://$1" target="BLANK">$1</a>',
                '<div style="text-align: $1;">$2</div>',
                '<a href="$1" target="_blank"><img src="$1" width="125" border="1px solid #200000" title="Click For Bigger Image"/></a>',
                '<a href="mailto:$1">$2</a>',
                '<a href="mailto:$1">$1</a>',
                '<span style="font-family: $1;">$2</span>',
                '<span style="font-size: $1;">$2</span>',
                '<span style="color: $1;">$2</span>',
                '<img src="./global/images/smilies/big_smile.png" border="">',
                '<img src="./global/images/smilies/cool.png" border="">',
                '<img src="./global/images/smilies/hmm.png" border="">',
                '<img src="./global/images/smilies/lol.png" border="">',
                '<img src="./global/images/smilies/mad.png" border="">',
                '<img src="./global/images/smilies/neutral.png" border="">',
                '<img src="./global/images/smilies/roll.png" border="">',
                '<img src="./global/images/smilies/sad.png" border="">',
                '<img src="./global/images/smilies/smile.png" border="">',
                '<img src="./global/images/smilies/tongue.png" border="">',
                '<img src="./global/images/smilies/wink.png" border="">',
                '<img src="./global/images/smilies/yikes.png" border="">',
                '<img src="./global/images/smilies/bhmm.png" border="">',
                '<img src="./global/images/smilies/bsmile.png" border="">',
                '<img src="./global/images/smilies/dsmile.png" border="">',
                '<img src="./global/images/smilies/blush.png" border="">',
                '<img src="./global/images/smilies/bunny.png" border="">',
                '<img src="./global/images/smilies/pumpkin.png" border="">',
                '&bull;',
                );

    // Do simple BBCode's
    $str = preg_replace ($token, $tokenized, $str);

    // Do <blockquote> BBCode
    $str = embedded ($str);
    return $str;
}



function embedded ($str) {
    $open = '<blockquote>';
    $close = '</blockquote>';

    // How often is the open tag?
    preg_match_all ('/\[quote\]/i', $str, $matches);
    $opentags = count($matches['0']);

    // How often is the close tag?
    preg_match_all ('/\[\/quote\]/i', $str, $matches);
    $closetags = count($matches['0']);

    // Check how many tags have been unclosed
    // And add the unclosing tag at the end of the message
    $unclosed = $opentags - $closetags;
    for ($i = 0; $i < $unclosed; $i++) {
        $str .= '</blockquote>';
    }

    // Do replacement
    $str = str_replace ('[' . 'quote]', $open, $str);
    $str = str_replace ('[/' . 'quote]', $close, $str);

    return $str;
} 

?>