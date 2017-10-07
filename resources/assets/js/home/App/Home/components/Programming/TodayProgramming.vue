<template>
  <div>
      <div class="row">
		<div class="col m12">
			<div class="card">
				<div class="card-header z-depth-2">
					Programação para hoje
				</div>
				<div class="card-content black-text">
					<table class="bordered">
                        <thead>
                        <tr>
                            <th>Programa</th>
                            <th>Hora</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="program in programming" :key="program.id">
                            <td>{{ program.name }}</td>
                            <td>{{ program.time }}</td>
                        </tr>
                        </tbody>
                    </table>
				</div>				
			</div>
		</div>
	</div>
  </div>
</template>

<script>
import { http } from '../../../../services'

export default {
    data() {
        return {
            programming: []
        }
    },

    created() {
        this.getTodayProgramming();
    },

    methods: {
        getTodayProgramming() {
            http.get('programming/today')
            .then( ({data}) => this.programming = data )
        }
    }
}
</script>

