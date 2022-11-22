<template>
  <div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Search Term</th>
          <th>Result</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(activity, index) in activities" :key="index">
          <td>{{ activity.search_term }}</td>
          <td>{{ activity.results_count }}</td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      activities: [],
    };
  },
  mounted() {
    console.log("Component mounted.");
    this.getActivities();
  },
  methods: {
    getActivities() {
      axios.get("/search-activity/get-activities").then((response) => {
        this.activities = response.data;
      });
    },
  },
};
</script>
