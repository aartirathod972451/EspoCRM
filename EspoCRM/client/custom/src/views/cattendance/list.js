define('custom:views/cattendance/list', ['views/list'], function (Dep) {

    return Dep.extend({
        
        setup: function () {
            // Force correct sorting BEFORE parent setup
            if (this.collection) {
                this.collection.sortBy = 'date';
                this.collection.asc = false;
                this.collection.orderBy = 'date';
                this.collection.order = 'desc';
                
                // Clear any stored sorting preferences
                this.collection.data.sortBy = 'date';
                this.collection.data.asc = false;
                this.collection.data.orderBy = 'date';
                this.collection.data.order = 'desc';
            }
            
            Dep.prototype.setup.call(this);
        },
        
        getCollection: function (reset) {
            var collection = Dep.prototype.getCollection.call(this, reset);
            
            if (collection) {
                collection.sortBy = 'date';
                collection.asc = false;
                collection.orderBy = 'date';
                collection.order = 'desc';
                
                // Override the URL parameters
                collection.url = collection.url.replace(/orderBy=[^&]*/, 'orderBy=date');
                collection.url = collection.url.replace(/order=[^&]*/, 'order=desc');
            }
            
            return collection;
        },
        
        afterRender: function () {
            Dep.prototype.afterRender.call(this);
            
            // Double-check after render
            if (this.collection && this.collection.orderBy === 'user') {
                this.collection.orderBy = 'date';
                this.collection.order = 'desc';
                this.collection.fetch();
            }
        }
    });
});