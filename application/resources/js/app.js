require('./bootstrap');

$(() => {
    $('.toggle_wish').on('click', (event) => {
        event.preventDefault();
        const $target = $(event.target).closest('a');
        const productId = $target.data('productId');
        const wished = $target.data('wished');

        axios({
            method: wished ? 'delete' : 'post',
            url: `/wish_products/${productId}`,
        }).then((response) => {
            if (wished) {
                $target.data('wished', false);
                $target.find('i').removeClass('fas');
                $target.find('i').addClass('far');
            } else {
                $target.data('wished', true);
                $target.find('i').removeClass('far');
                $target.find('i').addClass('fas');
            }
        });
    });
});
