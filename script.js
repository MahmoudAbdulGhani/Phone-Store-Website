

document.getElementById('searchBar').addEventListener('input', function() {
    let searchQuery = this.value.toLowerCase();
    // This can be expanded to filter products dynamically
    console.log('Searching for: ' + searchQuery);
});

//let addToCartButtons = document.querySelectorAll('.add-to-cart');
//addToCartButtons.forEach(button => {
  //  button.addEventListener('click', function() {
   //     alert('Product added to cart!');
  //  });
//});
