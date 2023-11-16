import { Form, Field, ErrorMessage } from 'vee-validate'

export default defineNuxtPlugin((app) => {
    app.vueApp.component('Form', Form)
    app.vueApp.component('Field', Field)
    app.vueApp.component('ErrorMessage', ErrorMessage)
})