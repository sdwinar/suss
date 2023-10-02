let bs4pop = {};

(function(pop) {


    pop.notice = function(content, opts, timesss = 3000, colorat = "yellow") {

        opts = $.extend(true, {

            type: 'warning', //primary, secondary, success, danger, warning, info, light, dark
            position: 'center', //topleft, topcenter, topright, bottomleft, bottomcenter, bottonright, center,

            autoClose: timesss


        }, opts);

        // 得到容器 $container
        let $container = $('#alert-container-' + opts.position);
        if (!$container.length) {
            $container = $('<div id="alert-container-' + opts.position + '" class="alert-container"></div>');
            $('body').append($container);
        }

        // alert $el
        let $el = $(`
			<div style="    background: black;
			text-align: center; right:38% !important;width:178% !important;font-size:1.1rem;color:${colorat}"
			 class="alert fade alert-${opts.type}" role="alert">${content}</div>
		`);

        // 关闭按钮
        if (opts.autoClose) {
            $el
                .append(`
					<button style="color:${colorat}" type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				`)
                .addClass('alert-dismissible');
        }

        //定时关闭
        if (opts.autoClose) {

            let t = setTimeout(() => {
                $el.alert('close');
            }, opts.autoClose);

        }

        opts.appendType === 'append' ? $container.append($el) : $container.prepend($el);

        setTimeout(() => {
            $el.addClass('show');
        }, 50);

        return;

    };

})(bs4pop);