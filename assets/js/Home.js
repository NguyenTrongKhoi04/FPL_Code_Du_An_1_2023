function onloadProduct(products, next, back,  classData, numberProductPage){


    document.addEventListener("DOMContentLoaded", function() {
        
        const productSection = document.getElementById(classData);
        const prevBtn = document.getElementById(back);
        const nextBtn = document.getElementById(next);
        
        const productsPerPage = numberProductPage; // Số lượng sản phẩm mỗi trang
        let currentPage = 0; // Trang hiện tại
        
        function displayProducts() {
            productSection.innerHTML = ""; // Xóa sản phẩm hiện tại trước khi hiển thị sản phẩm mới

            for (let i = currentPage * productsPerPage; i < (currentPage + 1) * productsPerPage; i++) {
                // console.log(products[i]);

                if (products[i]) {
                    const itemProduct = products[i];
                    productSection.innerHTML += `
                    <section class='lisstBestProducts'>
                        <img src='../assets/img/admin/${itemProduct['ImageProducts']}' alt='img'>
                        <article class='titile'>
                            <h1>${itemProduct['NameProducts']}</h1>
                        </article>
                        <article class='description'>
                            <p>${itemProduct['ProductDetails']}</p>
                        </article>
                    </section>
                `;
                }
            }
        }
        
        // Hiển thị sản phẩm khi trạng thái ban đầu
        displayProducts();
        

        // Xử lý sự kiện khi nhấn nút "prev" (sang trang trước)
        prevBtn.addEventListener("click", function() {
            if (currentPage > 0) {
                currentPage--;
                displayProducts();
            }
        });
        
        // Xử lý sự kiện khi nhấn nút "next" (sang trang tiếp theo)
        nextBtn.addEventListener("click", function() {
            if ((currentPage + 1) * productsPerPage < products.length) {
                currentPage++;
                displayProducts();
            }
        });
    }); 
}
