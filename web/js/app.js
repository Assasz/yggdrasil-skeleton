class App {
    constructor() {
        this.actions = {
            global: function () {
                // globally accessible action goes here
            }
        }
    }

    initPjax() {
        $(document).ready(function () {
            $(document).pjax('a:not([data-no-pjax])', '#pjax-container', {
                'timeout': 5000
            });

            $(document).on('submit', 'form[data-pjax]', function (event) {
                $.pjax.submit(event, '#pjax-container');
            });
        });

        return this;
    }

    initNProgress() {
        $(document).ready(function () {
            $(document).on('pjax:send', function () {
                NProgress.start();
            });

            $(document).on('pjax:end', function () {
                NProgress.done();
            });
        });

        return this;
    }

    run(action) {
        let that = this;

        $(document).ready(function () {
            that.actions[action]();
        });

        $(document).on('pjax:end', function () {
            that.actions[action]();
        });

        return this;
    }
}

const app = (new App())
    .initPjax()
    .initNProgress()
    .run('global');

