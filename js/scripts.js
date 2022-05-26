'use strict';

const toggleHidden = (...fields) => {

    fields.forEach((field) => {

        if (field.hidden === true) {

            field.hidden = false;

        } else {

            field.hidden = true;

        }
    });
};

const labelHidden = (form) => {

    form.addEventListener('focusout', (evt) => {

        const field = evt.target;
        const label = field.nextElementSibling;

        if (field.tagName === 'INPUT' && field.value && label) {

            label.hidden = true;

        } else if (label) {

            label.hidden = false;

        }
    });
};

const toggleDelivery = (elem) => {

    const delivery = elem.querySelector('.js-radio');
    const deliveryYes = elem.querySelector('.shop-page__delivery--yes');
    const deliveryNo = elem.querySelector('.shop-page__delivery--no');
    const fields = deliveryYes.querySelectorAll('.custom-form__input');

    delivery.addEventListener('change', (evt) => {

        if (evt.target.id === 'dev-no') {

            fields.forEach(inp => {
                if (inp.required === true) {
                    inp.required = false;
                }
            });


            toggleHidden(deliveryYes, deliveryNo);

            deliveryNo.classList.add('fade');
            setTimeout(() => {
                deliveryNo.classList.remove('fade');
            }, 1000);

        } else {

            fields.forEach(inp => {
                if (inp.required === false) {
                    inp.required = true;
                }
            });

            toggleHidden(deliveryYes, deliveryNo);

            deliveryYes.classList.add('fade');
            setTimeout(() => {
                deliveryYes.classList.remove('fade');
            }, 1000);
        }
    });
};

const filterWrapper = document.querySelector('.filter__list');
if (filterWrapper) {

    filterWrapper.addEventListener('click', evt => {

        const filterList = filterWrapper.querySelectorAll('.filter__list-item');

        filterList.forEach(filter => {

            if (filter.classList.contains('active')) {

                filter.classList.remove('active');

            }

        });

        const filter = evt.target;

        filter.classList.add('active');

    });

}

const shopList = document.querySelector('.shop__list');
if (shopList) {

    shopList.addEventListener('click', (evt) => {

        const prod = evt.path || (evt.composedPath && evt.composedPath());
        ;

        if (prod.some(pathItem => pathItem.classList && pathItem.classList.contains('shop__item'))) {

            const shopOrder = document.querySelector('.shop-page__order');

            toggleHidden(document.querySelector('.intro'), document.querySelector('.shop'), shopOrder);

            window.scroll(0, 0);

            shopOrder.classList.add('fade');
            setTimeout(() => shopOrder.classList.remove('fade'), 1000);

            const form = shopOrder.querySelector('.custom-form');
            labelHidden(form);

            toggleDelivery(shopOrder);

            const buttonOrder = shopOrder.querySelector('.button');
            const popupEnd = document.querySelector('.shop-page__popup-end');

            buttonOrder.addEventListener('click', (evt) => {

                form.noValidate = true;

                const inputs = Array.from(shopOrder.querySelectorAll('[required]'));

                inputs.forEach(inp => {

                    if (!!inp.value) {

                        if (inp.classList.contains('custom-form__input--error')) {
                            inp.classList.remove('custom-form__input--error');
                        }

                    } else {

                        inp.classList.add('custom-form__input--error');

                    }
                });

                if (inputs.every(inp => !!inp.value)) {

                    evt.preventDefault();

                    toggleHidden(shopOrder, popupEnd);

                    popupEnd.classList.add('fade');
                    setTimeout(() => popupEnd.classList.remove('fade'), 1000);

                    window.scroll(0, 0);

                    const buttonEnd = popupEnd.querySelector('.button');

                    buttonEnd.addEventListener('click', () => {


                        popupEnd.classList.add('fade-reverse');

                        setTimeout(() => {

                            popupEnd.classList.remove('fade-reverse');

                            toggleHidden(popupEnd, document.querySelector('.intro'), document.querySelector('.shop'));

                        }, 1000);

                    });

                } else {
                    window.scroll(0, 0);
                    evt.preventDefault();
                }
            });
        }
    });
}

const pageOrderList = document.querySelector('.page-order__list');
if (pageOrderList) {

    pageOrderList.addEventListener('click', evt => {


        if (evt.target.classList && evt.target.classList.contains('order-item__toggle')) {
            var path = evt.path || (evt.composedPath && evt.composedPath());
            Array.from(path).forEach(element => {

                if (element.classList && element.classList.contains('page-order__item')) {

                    element.classList.toggle('order-item--active');

                }

            });

            evt.target.classList.toggle('order-item__toggle--active');

        }

        if (evt.target.classList && evt.target.classList.contains('order-item__btn')) {

            const status = evt.target.previousElementSibling;

            if (status.classList && status.classList.contains('order-item__info--no')) {
                status.textContent = 'Выполнено';
            } else {
                status.textContent = 'Не выполнено';
            }

            status.classList.toggle('order-item__info--no');
            status.classList.toggle('order-item__info--yes');

        }

    });

}

const checkList = (list, btn) => {

    if (list.children.length === 1) {

        btn.hidden = false;

    } else {
        btn.hidden = true;
    }

};
const addList = document.querySelector('.add-list');
if (addList) {

    const form = document.querySelector('.custom-form');

    labelHidden(form);

    const addButton = addList.querySelector('.add-list__item--add');
    const addInput = addList.querySelector('#product-photo');

    checkList(addList, addButton);

    addInput.addEventListener('change', evt => {

        const template = document.createElement('LI');
        const img = document.createElement('IMG');

        template.className = 'add-list__item add-list__item--active';
        template.addEventListener('click', evt => {
            addList.removeChild(evt.target);
            addInput.value = '';
            checkList(addList, addButton);
        });

        const file = evt.target.files[0];
        const reader = new FileReader();

        reader.onload = (evt) => {
            img.src = evt.target.result;
            template.appendChild(img);
            addList.appendChild(template);
            checkList(addList, addButton);
        };

        reader.readAsDataURL(file);

    });

    /*const button = document.querySelector('.button');
    const popupEnd = document.querySelector('.page-add__popup-end');

    button.addEventListener('click', (evt) => {

        evt.preventDefault();

        form.hidden = true;
        popupEnd.hidden = false;

    })*/

}

const productsList = document.querySelector('.page-products__list');
if (productsList) {

    productsList.addEventListener('click', evt => {

        const target = evt.target;

        if (target.classList && target.classList.contains('product-item__delete')) {

            productsList.removeChild(target.parentElement);

        }

    });

}

// jquery range maxmin
if (document.querySelector('.shop-page')) {

    $('.range__line').slider({
        min: 350,
        max: 32000,
        values: [350, 32000],
        range: true,
        stop: function (event, ui) {

            $('.min-price').text($('.range__line').slider('values', 0) + ' руб.');
            $('.max-price').text($('.range__line').slider('values', 1) + ' руб.');

        },
        slide: function (event, ui) {

            $('.min-price').text($('.range__line').slider('values', 0) + ' руб.');
            $('.max-price').text($('.range__line').slider('values', 1) + ' руб.');

        }
    });

}

//my code
const countProductsPerPage = 9;

$('.filter__list-item').on('click', function () {
    //console.log(this.id);
    getProducts(1, this.id);
})

$('#apply').on('click',function() {
    getProducts(1, $('.active').attr('id'));
});

$('.shop__paginator').on('click', '.paginator__item', function() {
    getProducts(this.id, $('.active').attr('id'));
})

$('#new_items').on('click',function() {
    $('#sale').prop('checked', false);
    $('#new').prop('checked', true);
    getProducts(1, 'all');
});
$('#sale_items').on('click',function() {
    $('#new').prop('checked', false);
    $('#sale').prop('checked', true);
    getProducts(1, 'all');
});

function getProducts(page, category) {
    let ch_new;
    let ch_sale;
    let minPrice = $('.min-price').text().replace(/[^0-9]/g,"");
    let maxPrice = $('.max-price').text().replace(/[^0-9]/g,"");
    let sort = $('#sort').find(':selected').attr('value');
    let order = $('#order').find(':selected').attr('value');
    if ($('#new').prop('checked')) {
        ch_new = 1;
    } else {
        ch_new = null;
    }
    if ($('#sale').prop('checked')) {
        ch_sale = 1;
    } else {
        ch_sale = null;
    }

    /*console.log('cat ' + category);
    console.log('min ' + minPrice);
    console.log('max ' + maxPrice);
    console.log('new ' + ch_new);
    console.log('sale ' + ch_sale);
    console.log('sort ' + sort);
    console.log('order ' + order);
    console.log('page ' + page);*/

    $.get({
        url: '/functions/getProducts',
        data: {
            'category': category,
            'minPrice': minPrice,
            'maxPrice': maxPrice,
            'ch_new': ch_new,
            'ch_sale': ch_sale,
            'sort': sort,
            'order': order,
            'page': page,
        },
        success: function (data) {
            //console.log(data);
            let response = $.parseJSON(data);
            let count = response.count;
            let products = response.products;
            //let query = response.query;
            //console.log(count);
            //console.log(products);
            //console.log(query);
            addProductsCount(count);
            addTags(products);
            addPagination(count);
        },
        error: function(data) {
            console.log(data);
        },
    })
}

function addTags(products) {
    if (products.length === 0) {
        $('.shop__list').empty();
        $('.shop__list').append(
            "<p class=\"message\"></p>"
        );
        $('.message').html('По вашим критериям, не найдено ни одной модели.');
        return 0;
    }

    let count;

    if (products.length < countProductsPerPage) {
        count = products.length
    } else {
        count = countProductsPerPage
    }

    $('.shop__list').empty();
    for (let i = 0; i < count; i++) {
        $('.shop__list').append(
            "<article class=\"shop__item product\" tabIndex=\"0\">" +
            "<div class=\"product__image\">" +
            "<img alt=\"product-name\" id=\"product__image_" + i + "\">" +
            "</div>" +
            "<p class=\"product__name\" id=\"product__name_" + i + "\"></p>" +
            "<span class=\"product__price\" id=\"product__price_" + i + "\"></span>" +
            "</article>"
        );
        $(`#product__image_${i}`).attr('src', '/img/products/' + products[i].img);
        $(`#product__name_${i}`).html(products[i].name);
        $(`#product__price_${i}`).html(products[i].price + ' руб.');
    }

}

function addProductsCount(count) {
    $('#res-sort').html('');
    $('#res-sort').html(count);
}

function addPagination(count) {
    $('.shop__paginator').empty();
    for (let i = 1; i < Math.ceil(count / countProductsPerPage) + 1; i++) {
        $('.shop__paginator').append(
            "<li>" +
            "<a class=\"paginator__item\" id=\"" + i + "\" href=\"#\">" + i + "</a>" +
            "</li>"
        );
    }
}

$('.order-item__btn').on('click', function () {
    $.post({
        url: '/functions/changeOrderStatus',
        data: {
            'order_status': $('#' + this.name).textContent,
            'order_id': this.name,
        }
    })
})

$('.product-item__delete').on('click', function () {
    $.post({
        url: '/functions/hideProduct',
        data: {
            'product_id': $('#' + this.name).textContent,
        }
    })
})
