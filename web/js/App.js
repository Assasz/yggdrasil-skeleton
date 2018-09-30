/**
 * Application class
 */
class App {

    /**
     * Initializes properties
     */
    constructor() {
        this.isPjaxInitialized = false;
        this.isNProgressInitialized = false;
        this.actions = {};
        this.plugins = {};
        this.storage = {};
    }

    /**
     * Initializes Pjax
     *
     * @param {?object} options Pjax options
     * @return {App}
     */
    initPjax(options = null) {
        $(document).ready(function () {
            $(document).pjax('a:not([data-no-pjax])', '#pjax-container', (options === null) ? {
                'timeout': 5000
            } : options);

            $(document).on('submit', 'form[data-pjax]', function (event) {
                $.pjax.submit(event, '#pjax-container');
            });
        });

        this.isPjaxInitialized = true;
        this.onPjaxError();

        return this;
    }

    /**
     * Initializes NProgress
     * Ij Pjax is not initialized, Ajax events will be handled instead
     *
     * @return {App}
     */
    initNProgress() {
        $(document).ready(function () {
            if (this.isPjaxInitialized) {
                $(document).on('pjax:send', function () {
                    NProgress.start();
                });

                $(document).on('pjax:end', function () {
                    NProgress.done();
                });
            } else {
                $(document).ajaxStart(function() {
                    NProgress.start();
                });

                $(document).ajaxComplete(function() {
                    NProgress.done();
                });
            }
        });

        this.isNProgressInitialized = true;

        return this;
    }

    /**
     * Registers Pjax on error callback
     *
     * @param {?function} callback Sets default callback if null
     */
    onPjaxError(callback = null) {
        if (!this.isPjaxInitialized) {
            console.error('Pjax is not initialized.')

            return;
        }

        let self = this;

        $(document).ready(function () {
            $(document).on('pjax:error', (typeof callback === 'function') ? callback : function (xhr, textStatus) {
                if (textStatus.getResponseHeader('Content-Type').indexOf('html') > -1) {
                    let container = $(textStatus.responseText).filter('#pjax-container');

                    if (container.length) {
                        $('#pjax-container').replaceWith($(container));
                    }
                }

                if (self.isNProgressInitialized) {
                    NProgress.done();
                }
            });
        });
    }

    /**
     * Registers action
     *
     * @param {string}   name     Action name, equivalent to data-action HTML attribute
     * @param {string}   event    Event to bind action, use 'no-event' if no needed
     * @param {function} callback Action callback
     * @return {App}
     */
    register(name, event, callback) {
        if (typeof this.actions[name] !== 'undefined') {
            console.error(name + ' action already exist.');

            return this;
        }

        this.actions[name] = {
            event: event,
            callback: callback
        };

        return this;
    }

    /**
     * Runs given action
     *
     * @param {?string} action Name of action - if null, last registered action will be run
     * @return {App}
     */
    run(action = null) {
        if (null === action) {
            let actionsKeys = Object.keys(this.actions);

            action = actionsKeys[actionsKeys.length - 1];
        }

        if (typeof this.actions[action] === 'undefined') {
            console.error(action + ' action doesn\'t exist.');

            return this;
        }

        let self = this;

        $(document).ready(function () {
            if (this.isPjaxInitialized) {
                if ('no-event' === self.actions[action].event) {
                    self.actions[action].callback();
                } else {
                    $('#pjax-container').on(
                        self.actions[action].event,
                        '[data-action="' + action + '"]',
                        self.actions[action].callback
                    );
                }

                $(document).on('pjax:start', function () {
                   $('#pjax-container').off();
                });

                $(document).on('pjax:end', function () {
                    if ('no-event' === self.actions[action].event) {
                        self.actions[action].callback();
                    } else {
                        $('#pjax-container').on(
                            self.actions[action].event,
                            '[data-action="' + action + '"]',
                            self.actions[action].callback
                        );
                    }
                });
            } else {
                if ('no-event' === self.actions[action].event) {
                    self.actions[action].callback();
                } else {
                    $(document).on(
                        self.actions[action].event,
                        '[data-action="' + action + '"]',
                        self.actions[action].callback
                    );
                }
            }
        });

        return this;
    }

    /**
     * Mounts plugin
     *
     * @param {string} name   Name of plugin
     * @param {object} plugin Plugin object, which can be anonymous or class instance
     * @return {App}
     */
    mount(name, plugin) {
        if (typeof this.plugins[name] !== 'undefined') {
            console.error(name + ' plugin already exist.');

            return this;
        }

        this.plugins[name] = plugin;

        return this;
    }

    /**
     * Uses given plugin
     *
     * @param {string} plugin Name of plugin
     * @return {?object}
     */
    use(plugin) {
        if (typeof this.plugins[plugin] === 'undefined') {
            console.error(plugin + ' plugin doesn\'t exist.');

            return null;
        }

        return this.plugins[plugin];
    }

    /**
     * Stores data in storage
     *
     * @param {string} key   Key of data
     * @param {*}      value Value of data
     * @return {App}
     */
    store(key, value) {
        this.storage[key] = value;

        return this;
    }

    /**
     * Retrieves data from storage
     *
     * @param {string} key Key of data
     * @return {*}
     */
    retrieve(key) {
        return this.storage[key] || null;
    }
}
