<template>
  <q-page padding>
    <div v-if="!load">
      <q-calendar-month
        ref="calendar"
        v-model="selectedDate"
        animated
        bordered
        focusable
        hoverable
        no-active-date
        :day-min-height="140"
        :day-height="10"
        @change="onChange"
        @moved="onMoved"
        @click-date="onClickDate"
        @click-day="onClickDay"
        @click-workweek="onClickWorkweek"
        @click-head-workweek="onClickHeadWorkweek"
        @click-head-day="onClickHeadDay"
      >
        <template #day="{ scope: { timestamp } }">
          <template v-for="event in eventsMap[timestamp.date]" :key="event.id">
            <div
              :class="badgeClasses(event, 'day')"
              :style="badgeStyles(event, 'day')"
              class="my-event"
            >
              <abbr :title="event.details" class="tooltip">
                <span class="title q-calendar__ellipsis">{{
                  event.title + (event.time ? ' - ' + event.time : '')
                }}</span>
              </abbr>
            </div>
          </template>
        </template>
      </q-calendar-month>
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
      <div class="text-h6">Carregando Agendamentos...</div>
    </div>
  </q-page>
</template>

<script>
import { ref, onMounted } from 'vue'

import appointmentsAppointment from 'src/services/appointments.js'
// import { useQuasar } from 'quasar'
import {
  QCalendarMonth,
  addToDate,
  parseDate,
  parseTimestamp,
  today
} from '@quasar/quasar-ui-qcalendar'
import '@quasar/quasar-ui-qcalendar/src/QCalendarVariables.sass'
import '@quasar/quasar-ui-qcalendar/src/QCalendarTransitions.sass'
import '@quasar/quasar-ui-qcalendar/src/QCalendarMonth.sass'

const CURRENT_DAY = new Date()

export default {
  name: 'ListAppointmentPage',
  components: {
    QCalendarMonth
  },
  computed: {
    eventsMap() {
      const map = {}
      if (this.events.length > 0) {
        this.events.forEach((event) => {
          ;(map[event.date] = map[event.date] || []).push(event)
          if (event.days !== undefined) {
            let timestamp = parseTimestamp(event.date)
            let days = event.days
            // add a new event for each day
            // skip 1st one which would have been done above
            do {
              timestamp = addToDate(timestamp, { day: 1 })
              if (!map[timestamp.date]) {
                map[timestamp.date] = []
              }
              map[timestamp.date].push(event)
              // already accounted for 1st day
            } while (--days > 1)
          }
        })
      }
    //   console.log(map)
      return map
    }
  },
  setup() {
    // const $q = useQuasar()
    const load = ref(false)
    const { list } = appointmentsAppointment()
    const events = ref([])

    onMounted(() => {
      getAppointments()
      events.value = [
        {
          id: 1,
          title: 'Renata',
          details: 'Everything is funny as long as it is happening to someone else',
          date: getCurrentDay(1),
          bgcolor: 'orange'
        },
        {
          id: 2,
          title: 'My date 3',
          details: 'Everything is funny as long as it is happening to someone else',
          date: getCurrentDay(1),
          bgcolor: 'red'
        }
      ]
    })

    const formatAppointment = (data) => {
        console.log(data)
        const response = JSON.parse(JSON.stringify(data.value))
        return events.value.push(response.map((e) => {
            return {
                id: e.id,
                title: 'Serviço: ', // + e.service.name,
                details: 'Cliente:', // + e.customer.name,
                date: new Date(e.date_time),
                bgcolor: 'red'
            }
        })
        )
    }

    const getAppointments = async () => {
    //   try {
        formatAppointment(await list())
    //   } catch (error) {
    //     console.log('error')
    //   }
    }

    const getCurrentDay = (day) => {
      const newDay = new Date(CURRENT_DAY)
      newDay.setDate(day)
      const tm = parseDate(newDay)
      return tm.date
    }

    return {
      load,
      events,
      getCurrentDay,
      selectedDate: today()
    }
  },
  methods: {
    badgeClasses(event, type) {
      return {
        [`text-white bg-${event.bgcolor}`]: true,
        'rounded-border': true
      }
    },
    badgeStyles(day, event) {
      const s = {}
      // s.left = day.weekday === 0 ? 0 : (day.weekday * this.parsedCellWidth) + '%'
      // s.top = 0
      // s.bottom = 0
      // s.width = (event.days * this.parsedCellWidth) + '%'
      return s
    },
    onToday() {
      this.$refs.calendar.moveToToday()
    },
    onPrev() {
      this.$refs.calendar.prev()
    },
    onNext() {
      this.$refs.calendar.next()
    },
    onMoved(data) {
    //   console.log('onMoved', data)
    },
    onChange(data) {
    //   console.log('onChange', data)
    },
    onClickDate(data) {
    //   console.log('onClickDate', data)
    },
    onClickDay(data) {
    //   console.log('onClickDay', data)
    },
    onClickWorkweek(data) {
    //   console.log('onClickWorkweek', data)
    },
    onClickHeadDay(data) {
    //   console.log('onClickHeadDay', data)
    },
    onClickHeadWorkweek(data) {
    //   console.log('onClickHeadWorkweek', data)
    }
  }
}
</script>
