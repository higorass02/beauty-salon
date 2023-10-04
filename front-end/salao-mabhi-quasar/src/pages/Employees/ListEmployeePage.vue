<template>
  <q-page padding>
    <div v-if="!load">
      <q-table title="Funcionários" :rows="posts" :columns="columns" row-key="name">
        <template v-slot:top>
          <span class="text-h5">Funcionários</span>
          <q-space />
          <q-btn color="primary" label="Novo" :to="{ name: 'createEmployee' }" />
        </template>

        <template v-slot:body-cell-actions="props">
          <q-td :props="props">
            <q-btn
              push
              dense
              color="primary"
              size="md"
              icon="edit"
              @click="handleEdit(props.row.id)"
            />
            <q-btn
              push
              dense
              color="negative"
              class="q-ml-sm"
              size="md"
              icon="delete"
              @click="handleDelete(props.row.id)"
            />
          </q-td>
        </template>
      </q-table>
    </div>
    <div v-if="load" align="center">
      <q-circular-progress
        indeterminate
        size="50px"
        :thickness="0.22"
        rounded
        color="primary"
        track-color="grey-3"
        class="q-ma-md"
      />
      <div class="text-h6">Carregando Funcionários...</div>
    </div>
  </q-page>
</template>

<script>
import { ref, onMounted } from 'vue'
import serviceEmployee from 'src/services/employees.js'
import { useQuasar } from 'quasar'

export default {
  name: 'ListEmployeePage',
  setup () {
    const $q = useQuasar()
    const load = ref(true)
    const posts = ref([])
    const { list, remove } = serviceEmployee()

    const columns = [
      {
        name: 'id',
        field: 'id',
        label: 'ID',
        sortable: true,
        align: 'left'
      },
      {
        name: 'name',
        field: 'name',
        label: 'Nome',
        sortable: true,
        align: 'left'
      },
      {
        name: 'email',
        field: 'email',
        label: 'E-Mail',
        sortable: true,
        align: 'left'
      },
      {
        name: 'actions',
        field: 'actions',
        label: 'Ações',
        align: 'center'
      }
    ]

    onMounted(() => {
      getEmployee()
    })

    const getEmployee = async () => {
      try {
        const data = await list()
        posts.value = data.data
        load.value = false
      } catch (error) {
        console.log(error)
      }
    }

    const handleDelete = async (id) => {
      try {
        $q.dialog({
          title: 'Deleção ?',
          message: 'Deseja realmente deletar este funcionário ?',
          cancel: true,
          persistent: true
        }).onOk(async () => {
          $q.loading.show({
            message: 'Deletando funcionário....'
          })
          await remove(id)
          $q.loading.hide()
          load.value = true
          await getEmployee()
          load.value = false
          $q.notify({
            color: 'green-3',
            textColor: 'white',
            icon: 'check',
            message: 'Funcionário deletado com sucesso!'
          })
        })
      } catch (error) {
        $q.notify({
          color: 'red-5',
          textColor: 'white',
          icon: 'error',
          message: 'Erro ao deletar o funcionários'
        })
      }
    }

    const handleEdit = async (id) => {
      window.location.href = '/employee/' + id + '/edit'
    }

    return {
      load,
      posts,
      columns,
      handleDelete,
      handleEdit
    }
  }
}
</script>
