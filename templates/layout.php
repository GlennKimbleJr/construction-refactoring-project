<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?=$this->e(isset($title) ? $title : 'Construction Database')?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="all" />
<meta name="revisit-after" content="1 days" />
<link rel="stylesheet" type="text/css" href="includes/css/style.css" />
<link rel="stylesheet" type="text/css" href="includes/css/ddimgtooltip.css" />
<body>
    <center>
        <table width="820" cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td>
                    <?=$this->section('content')?>
                </td>
            </tr>
        </table>
    </center>

    <script src="includes/js/jquery.min.js"></script>
    <script src="includes/js/imtech_pager.js"></script>
    <script type="text/javascript">
        var pager = new Imtech.Pager();
        $(document).ready(function() {
            pager.paragraphsPerPage = 15; // set amount elements per page
            pager.pagingContainer = $('#pagenation'); // set of main container
            pager.paragraphs = $('div.z', pager.pagingContainer); // set of required containers
            pager.showPage(1);
        });
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script src="includes/js/ddimgtooltip.js"></script>
</body>
</html>