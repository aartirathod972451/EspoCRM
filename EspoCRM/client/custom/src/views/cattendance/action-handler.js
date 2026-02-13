define('custom:views/cattendance/action-handler', ['action-handler'], function (Dep) {

    return Dep.extend({

        actionClockIn: function (data, e) {
            console.log('Clock In action triggered');
            Espo.Ui.notify('Processing Clock In...');
            
            Espo.Ajax.postRequest('CAttendance/action/clockIn', {})
                .then(function (response) {
                    Espo.Ui.success(response.message);
                    
                    // Refresh the list view
                    if (this.view && this.view.collection) {
                        this.view.collection.fetch();
                    }
                    
                    // Show success dialog
                    Espo.Ui.success({
                        message: '✅ Clocked In: ' + response.time,
                        delay: 3000
                    });
                    
                    // Also show as modal for better visibility
                    this.createView('dialog', 'views/modal', {
                        templateContent: '<div class="record">' +
                            '<div style="text-align: center; padding: 20px;">' +
                            '<span class="fas fa-clock fa-3x text-success"></span>' +
                            '<h3 style="color: #28a745;">Clock In Successful</h3>' +
                            '<p><strong>Time:</strong> ' + response.time + '</p>' +
                            '<p><strong>Date:</strong> ' + response.date + '</p>' +
                            '</div>' +
                            '</div>',
                        headerText: '✅ Clock In',
                        width: '400px',
                        backdrop: true
                    }, function (view) {
                        view.render();
                        
                        // Auto close after 3 seconds
                        setTimeout(function() {
                            view.close();
                        }, 3000);
                    });
                    
                }.bind(this))
                .fail(function (xhr) {
                    var msg = xhr.getResponseHeader('X-Status-Reason') || 'Clock In failed';
                    Espo.Ui.error(msg);
                    
                    this.createView('dialog', 'views/modal', {
                        templateContent: '<div class="record text-danger">' +
                            '<div style="text-align: center; padding: 20px;">' +
                            '<span class="fas fa-exclamation-triangle fa-3x"></span>' +
                            '<h3 style="color: #dc3545;">Clock In Failed</h3>' +
                            '<p>' + msg + '</p>' +
                            '</div>' +
                            '</div>',
                        headerText: '❌ Error',
                        width: '400px'
                    }, function (view) {
                        view.render();
                    });
                    
                }.bind(this));
        },

        actionClockOut: function (data, e) {
            Espo.Ui.notify('Processing Clock Out...');
            
            Espo.Ajax.postRequest('CAttendance/action/clockOut', {})
                .then(function (response) {
                    Espo.Ui.success(response.message);
                    
                    // Refresh the list view
                    if (this.view && this.view.collection) {
                        this.view.collection.fetch();
                    }
                    
                    // Show success dialog
                    this.createView('dialog', 'views/modal', {
                        templateContent: '<div class="record">' +
                            '<div style="text-align: center; padding: 20px;">' +
                            '<span class="fas fa-clock fa-3x text-danger"></span>' +
                            '<h3 style="color: #dc3545;">Clock Out Successful</h3>' +
                            '<p><strong>Time:</strong> ' + response.time + '</p>' +
                            '<p><strong>Total Hours:</strong> ' + response.totalHours + ' hours</p>' +
                            '</div>' +
                            '</div>',
                        headerText: '✅ Clock Out',
                        width: '400px',
                        backdrop: true
                    }, function (view) {
                        view.render();
                        
                        setTimeout(function() {
                            view.close();
                        }, 3000);
                    });
                    
                }.bind(this))
                .fail(function (xhr) {
                    var msg = xhr.getResponseHeader('X-Status-Reason') || 'Clock Out failed';
                    Espo.Ui.error(msg);
                    
                    this.createView('dialog', 'views/modal', {
                        templateContent: '<div class="record text-danger">' +
                            '<div style="text-align: center; padding: 20px;">' +
                            '<span class="fas fa-exclamation-triangle fa-3x"></span>' +
                            '<h3 style="color: #dc3545;">Clock Out Failed</h3>' +
                            '<p>' + msg + '</p>' +
                            '</div>' +
                            '</div>',
                        headerText: '❌ Error',
                        width: '400px'
                    }, function (view) {
                        view.render();
                    });
                    
                }.bind(this));
        },
        
        actionMyHistory: function () {
            this.view.getRouter().navigate('#CAttendance/list/own', {trigger: true});
        }
    });
});