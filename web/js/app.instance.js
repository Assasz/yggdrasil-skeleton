/**
 * Application instance
 *
 * @type {App}
 */
const app = (new App())
    .initPjax()
    .initNProgress()
    .mount('yjax', new YjaxPlugin());
