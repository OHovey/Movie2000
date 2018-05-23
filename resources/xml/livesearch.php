<?php



ini_set("display_errors", 0);

$xml = new XMLReader();
$xml->open("movie_details.xml");

$q = $_GET['q'];

$location = array();

if (strlen($q) > 0)
{
    $hint = '';
    $count = 5;

    while ($xml->read())
    {
        if ($xml->nodeType == XMLREADER::ELEMENT && $xml->localName == 'column')
        {
            
            if ($xml->getAttribute('name') == 'COL 1') 
            {
                $xml->read();
                
                if (stristr(substr($xml->value, 0, strlen($q)), $q))
                {
                    if ($hint == '')
                    {
                        $hint .= '<a href="#" style="text-decoration: none;"><div class="list-group-item search-items" onclick="inputSearchItem(this.innerText), injectGet(this.innerText)">' . '<strong>' . substr($xml->value, 0, strlen($q)) . '</strong>' . substr($xml->value, strlen($q), strlen($xml->value)) . '</div></a>';
                        $count--;
                    }
                    else
                    {
                        $hint .= '<br><a href="#" style="color: black;"><div class="search-items" onclick="inputSearchItem(this.innerText), injectGet(this.innerText)"> ' . '<strong>' . substr($xml->value, 0, strlen($q)) . '</strong>' . substr($xml->value, strlen($q), strlen($xml->value)) . '</div></a>';
                        $count--;
                        if ($count == 0)
                        {
                            break;
                        }
                    }
                }
            } 
        }
    }
}
    
if ($hint == '')
{
    return null;
}
else 
{
    $response = $hint;
}

echo $response;


?>