const input = document.getElementById("quantity");
const increaseButton = document.getElementById("increase");
const decreaseButton = document.getElementById("decrease");
const maxQuantity = parseInt(input.getAttribute("data-max")); // Lấy giá trị từ data attribute

increaseButton.addEventListener("click", function () {
    const currentValue = parseInt(input.value);

    if (currentValue < maxQuantity) {

        input.value = currentValue + 1;
    }
});

decreaseButton.addEventListener("click", function () {
    const currentValue = parseInt(input.value);
    if (currentValue > 1) {
        input.value = currentValue - 1;
    }
});

var maxQualityComment = document.getElementById('list_comment').getAttribute("data-value");
document.getElementById('tang').addEventListener('click', function() {
    var url = new URL(window.location.href);
    var indexValue = url.searchParams.get('index');
    if(indexValue < maxQualityComment){
        indexValue++; 
    }else{
        indexValue = 1;
    }
    
    // Cập nhật URL với giá trị index mới
    var newUrl = window.location.href.replace(/(\?|&)index=\d+/, '$1index=' + indexValue);
    window.history.replaceState({}, '', newUrl);
    window.location.reload();
  });
document.getElementById('giam').addEventListener('click', function() {
    var url = new URL(window.location.href);
    var indexValue = url.searchParams.get('index');
    console.log(indexValue);
    if(indexValue <= maxQualityComment ){
        indexValue --; 
    }
    if(indexValue === 0){
        indexValue = maxQualityComment;
    }
    
    // Cập nhật URL với giá trị index mới
    var newUrl = window.location.href.replace(/(\?|&)index=\d+/, '$1index=' + indexValue);
    window.history.replaceState({}, '', newUrl);
    window.location.reload();
  });
  


