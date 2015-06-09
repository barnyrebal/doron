<?php

    function DOMinnerHTML(DOMNode $element)
    {
        $innerHTML = "";
        $children  = $element->childNodes;

        foreach ($children as $child)
        {
            $innerHTML .= $element->ownerDocument->saveHTML($child);
        }

        return $innerHTML;
    }


$post = $_POST;
    $response = array(
        ['images'] => null,
        ['links'] => null,
        ['result'] => null,
        ['isUrlRequest'] => null
    );


    //$url = "http://www.erezart.co.il";
    //$url="http://callvu/";

     if(filter_var($post['url'], FILTER_VALIDATE_URL)){
        // you're good
         $html = file_get_contents($post['url']);
         $response['isUrlRequest'] = true;
    }else{
         $html = $post['url'];
         $response['isUrlRequest'] = false;
     }

    $doc = new DOMDocument();
    @$doc->loadHTML($html);

    if ($post['images']){
        $tags = $doc->getElementsByTagName('img');
        if ($tags->length > 0){
            $images = array();
            foreach ($tags as $tag) {
                $images[] = $tag->getAttribute('src');;
            }

            $response['images'] = $images ;
        }
    }


    if ($post['links']) {

        $tags = $doc->getElementsByTagName('a');
        if ($tags->length > 0) {
            $links = array();
            foreach ($tags as $tag) {
                $link = array();
                if (!empty($tag->getAttribute('href')) && !empty($tag->textContent)){
                    $link['href'] = $tag->getAttribute('href');

                    $link['text'] = DOMinnerHTML($tag);

                    //$link['text'] = $tag->textContent;

                    $links[] = $link;
                }
            }

            $response['links'] = $links;
        }
    }

    if ($response['links'] || $response['images']) {
        $response['result'] = 'OK';
    } else {
        $response['result'] = 'EMPTY';
    }

    echo json_encode($response);
    //echo json_encode($post);