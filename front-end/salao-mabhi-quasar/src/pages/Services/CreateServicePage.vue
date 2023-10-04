<template>
  <q-page padding>
    <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md q-pa-md">
      <q-input
        filled
        v-model="form.name"
        label="Nome do serviço"
        hint="Nome do serviço"
        lazy-rules
        :rules="[
          (val) => (val && val.length > 0) || 'Por favor entre com o Nome serviço'
        ]"
      />

      <q-input
        filled
        type="float"
        v-model="form.price"
        label="preço"
        lazy-rules
        :rules="[
          (val) => (val !== null && val !== '') || 'Por favor entre com o preço'
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
        <q-btn label="Cancelar" type="reset" color="red" class="float-right"/>
      </div>
    </q-form>
  </q-page>
</template>

<script>
import { ref } from 'vue'
import { useQuasar } from 'quasar'
import serviceService from 'src/services/services.js'

export default {
  name: 'CreateServicePage',
  setup () {
    const $q = useQuasar()
    const { post } = serviceService()
    const form = ref({
      name: '',
      price: ''
    })

    const onReset = (form) => {
      form.value.name = ''
      form.value.price = ''
    }

    const onSubmit = async () => {
      $q.loading.show({
        message: 'Inserindo serviço na base de dados...'
      })
      try {
        await post(form.value)
        $q.loading.hide()
        $q.notify({
          color: 'green-3',
          textColor: 'white',
          icon: 'check',
          message: 'Serviço Cadastrado com sucesso'
        })
        $q.dialog({
          title: 'Novo Cadastro ?',
          message: 'Deseja inserir outro serviço ?',
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
            window.location.href = '/service'
          })
      } catch (error) {
        console.log(error)
        $q.notify({
          color: 'red-5',
          textColor: 'white',
          icon: 'check',
          message: 'Erro ao cadastrar o serviço'
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
