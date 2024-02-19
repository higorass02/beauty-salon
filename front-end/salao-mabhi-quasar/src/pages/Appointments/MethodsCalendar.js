export default function methodsCalendar () {
    function badgeClasses (event, type) {
        return {
            [`text-white bg-${event.bgcolor}`]: true,
            'rounded-border': true
        }
    }
    /*,
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
        console.log('onMoved', data)
      },
      onChange(data) {
        console.log('onChange', data)
      },
      onClickDate(data) {
        console.log('onClickDate', data)
      },
      onClickDay(data) {
        console.log('onClickDay', data)
      },
      onClickWorkweek(data) {
        console.log('onClickWorkweek', data)
      },
      onClickHeadDay(data) {
        console.log('onClickHeadDay', data)
      },
      onClickHeadWorkweek(data) {
        console.log('onClickHeadWorkweek', data)
      }
      */

    return {
        badgeClasses
    }
}
