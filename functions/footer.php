                    
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
