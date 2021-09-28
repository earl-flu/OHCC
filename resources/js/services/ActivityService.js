const apiClient = axios.create({
    baseURL: `http://127.0.0.1:8000/api`,
    withCredentials: false, // This is the default
    headers: {
        Accept: "application/json",
        "Content-Type": "application/json"
    }
});

export default {
    // should be yyyy-mm-dd format
    getActivities(startDate, endDate) {
        return apiClient.get(
            "/activities?_startDate=" + startDate + "&_endDate=" + endDate
        );
    }

    //   getEvent(id) {
    //     return apiClient.get('events/' + id);
    //   },
};
