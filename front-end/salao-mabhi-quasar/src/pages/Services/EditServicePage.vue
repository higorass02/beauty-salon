<template>
  <q-page padding>
    <div align="center">
      <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md q-pa-md">
        <q-input
          filled
          v-model="form.name"
          label="Nome do serviço"
          hint="Nome do serviço"
          lazy-rules
          :rules="[
            (val) => (val && val.length > 0) || 'Por favor entre com o Nome do serviço'
          ]"
        />

        <q-input
          filled
          type="price"
          v-model="form.price"
          label="Preço"
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
          <q-btn label="Cancelar" type="reset" color="red" class="float-right" />
        </div>
      </q-form>
    </div>
  </q-page>
</template>

<script>
import { ref, onMounted } from 'vue'
import { useQuasar } from 'quasar'
import serviceService from 'src/services/services.js'
import { useRoute } from 'vue-router'

export default {
  name: 'EditServicePage',
  setup () {
    const $q = useQuasar()
    const route = useRoute()
    const { findOne, update } = serviceService()
    const form = ref({
      id: 0,
      name: '',
      price: ''
    })

    $q.loading.show({
      message: 'carregando dados!'
    })

    const onReset = (form) => {
      form.value.name = ''
      form.value.price = ''
    }

    onMounted(async () => {
      form.value.id = route.params.id ?? 0
      const data = await findOne(route.params.id)
      const dataClient = data.data
      form.value.name = dataClient.name
      form.value.price = dataClient.price
      $q.loading.hide()
    })

    const onSubmit = async () => {
      $q.loading.show({
        message: 'Editando Serviço na base de dados ...'
      })
      try {
        await update(form.value)
        $q.loading.hide()
        $q.notify({
          color: 'green-3',
          textColor: 'white',
          icon: 'check',
          message: 'Serviço editado com sucesso!'
        })
        setTimeout(() => {
          window.location.href = '/service'
        }, 500)
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
