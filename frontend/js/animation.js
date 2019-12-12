        $(window).on('load', function () {
            anime({
                targets: '#img',
                scaleY: [0, 1],
                duration: 2500,
                delay: anime.stagger(100),
                easing: 'easeOutElastic(0,0.3)'
            }).finished.then(function () {
                anime({
                    targets: '#img',
                    scaleY: [{
                            value: [1, 0.8],
                            easing: 'easeInElastic(0,2)'
                        },
                        {
                            value: [0.8, 1],
                            easing: 'easeOutElastic(0,2)'
                        }
                    ],
                    duration: 1000,
                    loop: true,
                    delay: anime.stagger(100, {
                        start: 2000
                    })
                });
            });
        }); 