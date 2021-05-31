document.addEventListener('DOMContentLoaded', function () {
    app.init()
})

let app = {
    init() {},

    toggle_task_status(e, id) {
        if (typeof Number(id) !== 'number') throw new Error('Error: invalid id of task')

        if (e.classList.contains('task_done')) this.class_replace(e, 'task_done', 'task_not_done')
        else if (e.classList.contains('task_not_done')) this.class_replace(e, 'task_not_done', 'task_done')

        this.request('/tasks/toggle_status', { id }, function () {

        })
    },

    request(url, data, callback) {
        let xhr = new XMLHttpRequest();
        if (!xhr) return;
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded')
        xhr.send(this.request_serialize(data));
        xhr.onreadystatechange = function() {
            if (xhr.readyState !== 4) return;
            if (xhr.status === 200) callback(xhr.responseText);
            xhr = null;
        }
    },

    request_serialize(data, prefix) {
        let str = [], p;

        for (p in data) {
            if (data.hasOwnProperty(p)) {
                let k = prefix ? `${prefix}[${p}]` : p, // `prefix + "[" + p + "]"
                    v = data[p];
                str.push((v !== null && typeof v === "object") ?
                    this.request_serialize(v, k) : encodeURIComponent(k) + "=" + encodeURIComponent(v));
            }
        }

        return str.join("&");
    },

    class_replace(el, replace_class, add_class) {
        el.classList.remove(replace_class)
        el.classList.add(add_class)
    }

}