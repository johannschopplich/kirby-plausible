import DashboardView from "./components/DashboardView.vue";

window.panel.plugin("johannschopplich/plausible", {
  components: {
    "k-plausible-view": DashboardView,
  },
});
