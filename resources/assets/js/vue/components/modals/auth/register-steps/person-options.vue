<template>
	<div>
		<h2 style="text-align: center;">Add any other Directors, Owners and Executives’ </h2>
		<div class="persons-block">
			<div v-if="$store.state.app.account.persons.length > 0"
				v-for="(person, index) in $store.state.app.account.persons"
				style="display: flex; justify-content: space-between;padding:10px">
				<span>{{ person.first_name }} {{ person.last_name }}: {{ person.relationship }}, percentage {{
					person.percentage }}% </span>
				<div>
					<ph-button size="small" @click.native="handleEdit($event, index)">
						Edit
					</ph-button>
					<ph-button size="small" @click.native="handleRemove($event, index)">
						Remove
					</ph-button>
				</div>
			</div>
		</div>

		<ph-button size="medium" @click.native="handleAddPerson($event)">
			Add a Person
		</ph-button>
		<hr>
		<div class="submit-buttons">
			<div class="button-wrap">
				<ph-button size="medium" @click.native="handleSubmit($event)">
					Save & Continue
				</ph-button>
			</div>
		</div>
	</div>
</template>

<script>
import { mapGetters, mapState } from "vuex";
export default {
	name: "person-options",
	data() {
		return {
			submitting: false,
		};
	},

	mounted() { },

	computed: {
		...mapGetters({
			tempUser: "app/getTempUser",
		})
	},

	methods: {
		handleAddPerson(event){
			event.preventDefault();
			this.$emit('addPerson');
		},
		handleEdit(event, index) {
			event.preventDefault();
			console.log(this.$store.state.app.account.persons[index]);
			const person = this.$store.state.app.account.persons[index];
			this.$emit('editPerson', person);
		},
		handleRemove(event, index) {
			event.preventDefault();
			console.log(this.$store.state.app.account.persons[index]);
			this.$store.state.app.account.persons.splice(index, 1);
		},
		handleSubmit(event, index) {
			event.preventDefault();
			this.$emit('next-step');
			// console.log(this.$store.state.app.account.persons[index]);
			// this.$store.state.app.account.persons.splice(index, 1);
		},
	},
};
</script>

<style lang="scss" scoped>
@import "~styles/helpers/_variables.scss";

.persons-block {
	margin: 20px 0px;
}

ul.gridtypelist li label {
	display: block;
	color: $color-grey3;
	text-align: center;
	padding: 8px;
	text-decoration: none;
	border: 2px $color-blue solid;
	border-radius: 10px;
	margin: 2px;
	background-color: #f1f1f1;
}

ul.gridtypelist li label:hover {
	background-color: $color-2;
	color: $color-grey3;
}

ul.gridtypelist li label.active {
	background-color: $color-2;
	color: #fff;
}

ul.gridtypelist li label input[type="radio"] {
	display: none;
}

.submit-buttons {
	display: flex;
	flex-direction: column;

	.button-wrap {
		padding: 10px 0;
		display: flex;
		justify-content: center;
	}
}

.full-width {
	flex-basis: 100%;
}

.dob-fields {

	input,
	select {
		margin: 10px 0;
	}
}

.input {
	flex: 1;
	display: flex;
	margin: 1.8em 0;
	width: 48%;
	padding: 0 20px;

	&>div:first-of-type {
		width: 125px;
		display: flex;
		align-items: center;
	}

	&>div:last-of-type {
		flex: 1;
		position: relative;
	}

	input,
	select {
		padding: 10px !important;
		box-sizing: border-box;
		font-size: 17px !important;
		border: 1px solid $color-grey4 !important;
		border-radius: 3px;
	}
}
</style>
