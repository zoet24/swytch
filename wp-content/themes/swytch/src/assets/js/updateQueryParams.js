function updateQueryParams(event) {
    const form = event.target.form;
    let queryParams = new URLSearchParams(window.location.search);
    queryParams.set(event.target.name, event.target.value);
    window.location.search = queryParams.toString();
}