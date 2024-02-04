import { Form, Field, ErrorMessage, configure } from 'vee-validate'

configure({
    validateOnBlur: true,
    validateOnInput: true,
});

export default defineNuxtPlugin((app) => {
    app.vueApp.component('Form', Form)
    app.vueApp.component('Field', Field)
    app.vueApp.component('ErrorMessage', ErrorMessage)
})
