<script>
    $(document).ready(function() {
        $(window).scroll(function() {
            if($(this).scrollTop() > 150) {
                $("#cart-right").removeClass("cart-right");
                $("#cart-right").addClass("fix-cart");
                
                var parentCart = $("#parent-cart").width();
                $("#cart-right").css("width", parentCart + "px");
            }
            else {
                $("#cart-right").removeClass("fix-cart");
                $("#cart-right").addClass("cart-right");
            }
        });
    });

    function getPageList(totalPages, page, maxLength) {
        if (maxLength < 5) throw "maxLength must be at least 5";

        function range(start, end) {
            return Array.from(Array(end - start + 1), (_, i) => i + start);
        }

        var sideWidth = maxLength < 9 ? 1 : 2;
        var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
        var rightWidth = (maxLength - sideWidth * 2 - 2) >> 1;

        if(totalPages <= maxLength) {
            return range(1, totalPages);
        }

        if(totalPages <= maxLength - sideWidth - 1 - rightWidth) {
            return range(1, maxLength - sideWidth - 1)
                .concat([0])
                .concat(range(totalPages - sideWidth + 1, totalPages));
        }

        if(page >= totalPages - sideWidth - 1 - rightWidth) {
            return range(1, sideWidth)
                .concat([0])
                .concat(
                    range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages)
                );
        }

        return range(1, sideWidth)
            .concat([0])
            .concat(range(page - leftWidth, page + rightWidth))
            .concat([0])
            .concat(range(totalPages - sideWidth + 1, totalPages));
    }

    $(function() {
        var numberOfItems = $("#row-data #col-data").length;
        var limitPerPage = 9;
        var totalPages = Math.ceil(numberOfItems / limitPerPage);

        var paginationSize = 7;
        var currentPage;

        function showPage(whichPage) {
            if(whichPage < 1 || whichPage > totalPages) return false;
            currentPage = whichPage;
            $("#row-data #col-data")
                .hide()
                .slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage)
                .show();
            
            $(".pagination li").slice(1, -1).remove();
            getPageList(totalPages, currentPage, paginationSize).forEach(item => {
                $("<li>")
                    .addClass(
                        "page-item " +
                        (item ? "current-page " : "") +
                        (item === currentPage ? "active " : "")
                    )
                    .append(
                        $("<a>")
                            .addClass("page-link")
                            .attr({
                                href: "javascript:void(0)"
                            })
                            .text(item || "...")
                    )
                    .insertBefore("#next-page");
            });
            return true;
        }

        $(".pagination").append(
            $("<li>").addClass("page-item").attr({ id: "previous-page" }).append(
                $("<a>")
                    .addClass("page-link")
                    .attr({
                        href: "javascript:void(0)"
                    })
                    .text("Sebelumnya")
            ),
            $("<li>").addClass("page-item").attr({ id: "next-page" }).append(
                $("<a>")
                    .addClass("page-link")
                    .attr({
                        href: "javascript:void(0)"
                    })
                    .text("Selanjutnya")
            )
        );

        $("#row-data").show();
        showPage(1);

        $(document).on("click", ".pagination li.current-page:not(.active)", function() {
            return showPage(+$(this).text());
        });
        $("#next-page").on("click", function() {
            return showPage(currentPage + 1);
        });
        $("#previous-page").on("click", function() {
            return showPage(currentPage - 1);
        });
        $(".pagination").on("click", function() {
            $("#col-left").animate({ scrollTop: 0}, 50);
        });
    });
</script>