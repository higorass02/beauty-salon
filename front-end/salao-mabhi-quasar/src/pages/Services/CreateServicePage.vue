<template>
  <q-page padding>
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
        :rules="[(val) => (val !== null && val !== '') || 'Por favor entre com o E-mail']"
      />

      <div class="col-lg-12 q-gutter-sm">
        <q-btn
          label="Salvar"
          color="primary"
          class="float-right"
          icon="save"
          type="submit"
        />
        <q-btn label="Cancelar" type="reset" color="red" class="float-right"/>
      </div>
    </q-form>
  </q-page>
</template>

<script>
import { ref } from 'vue'
import { useQuasar } from 'quasar'
import customerService from 'src/services/customers.js'

export default {
  name: 'CreateServicePage',
  setup () {
    const $q = useQuasar()
    const { post } = customerService()
    const form = ref({
      name: '',
      phone: '',
      email: ''
    })

    const onReset = (form) => {
      form.value.name = ''
      form.value.phone = ''
      form.value.email = ''
    }

    const onSubmit = async () => {
      $q.loading.show({
        message: 'Inserindo Cliente na base de dados...'
      })
      try {
        await post(form.value)
        $q.loading.hide()
        $q.notify({
          color: 'green-3',
          textColor: 'white',
          icon: 'check',
          message: 'Cliente Cadastrado com sucesso'
        })
        $q.dialog({
          title: 'Novo Cadastro ?',
          message: 'Deseja inserir outro cliente ?',
          ok: {
            push: true,
            label: 'Sim'
          },
          cancel: {
            push: true,
            color: 'negative',
            label: 'Não'
          },
          persistent: true
        })
          .onOk(async () => {
            onReset(form)
          })
          .onCancel(() => {
            window.location.href = '/customer'
          })
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
