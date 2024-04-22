<?php
function validationPage(int $page,int $pageNumber)
{
    
return ($page >= 1 and $page <= $pageNumber) ;
}

?>