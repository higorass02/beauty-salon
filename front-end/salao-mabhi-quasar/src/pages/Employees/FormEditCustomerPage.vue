<template>
  <q-page padding>
    <div align="center">
      <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md q-pa-md">
        <q-input
          filled
          v-model="form.name"
          label="Nome do Cliente"
          hint="Nome Completo"
          lazy-rules
          :rules="[
            (val) => (val && val.length > 0) || 'Por favor entre com o Nome Completo'
          ]"
        />

        <q-input
          filled
          type="phone"
          v-model="form.phone"
          label="Celular"
          lazy-rules
          :rules="[
            (val) => (val !== null && val !== '') || 'Por favor entre com o celular'
          ]"
        />

        <q-input
          filled
          type="email"
          v-model="form.email"
          label="E-Mail"
          lazy-rules
          :rules="[
            (val) => (val !== null && val !== '') || 'Por favor entre com o E-mail'
          ]"
        />

        <div class="col-lg-12 q-gutter-sm">
          <q-btn
            label="Salvar"
            color="primary"
            class="float-right"
            icon="save"
            type="submit"
          />
          <q-btn label="Cancelar" type="reset" color="red" class="float-right" />
        </div>
      </q-form>
    </div>
  </q-page>
</template>

<script>
import { ref, onMounted } from 'vue'
import { useQuasar } from 'quasar'
import customerService from 'src/services/customers.js'
import { useRoute } from 'vue-router'

export default {
  name: 'FormCustomerPage',
  setup () {
    const $q = useQuasar()
    const route = useRoute()
    const { findOne, update } = customerService()
    const form = ref({
      id: 0,
      name: '',
      phone: '',
      email: ''
    })

    $q.loading.show({
      message: 'carregando dados!'
    })

    const onReset = (form) => {
      form.value.name = ''
      form.value.phone = ''
      form.value.email = ''
    }

    onMounted(async () => {
      form.value.id = route.params.id ?? 0
      const data = await findOne(route.params.id)
      const dataClient = data.data
      form.value.name = dataClient.name
      form.value.phone = dataClient.phone
      form.value.email = dataClient.email
      $q.loading.hide()
    })

    const onSubmit = async () => {
      $q.loading.show({
        message: 'Editando Cliente na base de dados ...'
      })
      try {
        await update(form.value)
        $q.loading.hide()
        $q.notify({
          color: 'green-3',
          textColor: 'white',
          icon: 'check',
          message: 'Cliente editado com sucesso!'
        })
        setTimeout(() => {
          window.location.href = '/customer'
        }, 500)
      } catch (error) {
        console.log(error)
        $q.notify({
          color: 'red-5',
          textColor: 'white',
          icon: 'check',
          message: 'Erro ao cadastrar o cliente'
        })
      }
    }

    return {
      form,
      onSubmit,
      onReset
    }
  }
}
</script>
