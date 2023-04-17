// // cart
// let cartDiv = document.querySelector('#cart');
// let cart = localStorage.getItem('products');
// let htmlString = '';
// let total = 0;
// if (cart != null) {
//     cart = JSON.parse(cart)
//     cart.forEach(item => {
//         htmlString += `<tr><td>${item.id}</td><td> ${item.name}</td><td> ${item.quantity}</td><td> ${item.price}</td><td> ${item.price * item.quantity}</td></tr> `;
//         total += item.price * item.quantity
//         cartDiv.innerHTML = htmlString;
//     });
// }
// total += document.querySelector('#ship-fee').value
// document.querySelector('#total').innerHTML = total

// // customer
// let cusDiv = document.querySelector('#customer');
// let customer = localStorage.getItem('customer');
// let htmlCustomer = '';
// if (customer != null) {
//     customer = JSON.parse(customer);
//     htmlCustomer += `<p>Tên khách: <span>${customer.name}</span></p><p>Địa chỉ: <span>${customer.address}</span></p><p>SĐT: <span>${customer.phone}</span></p>`;
//     cusDiv.innerHTML = htmlCustomer;
// }


// if (cart == null && customer == null) {
//     let cartBox = document.querySelector('#cart-box');
//     cartBox.style.display = 'none';
// }

// if (cart != null && customer != null) {
//     let submitOrderBtn = document.querySelector('#submit-order');
//     submitOrderBtn.removeAttribute('disabled')
// }
