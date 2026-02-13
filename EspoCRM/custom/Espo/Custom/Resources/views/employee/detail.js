define('custom:views/employee/detail', ['views/detail'], function (Dep) {
    return Dep.extend({
        afterRender: function () {
            Dep.prototype.afterRender.call(this);
            
            // Load banks AFTER render
            setTimeout(() => {
                this.model.fetchLinkMultiple('employeeBanks', {
                    statusField: null
                }).then(() => {
                    this.model.trigger('after:load-employee-banks');
                });
            }, 500);
        }
    });
});
