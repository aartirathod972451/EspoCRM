define('custom:views/cemployee/record/detail', ['views/record/detail'], function (Dep) {
    return Dep.extend({
        template: 'custom:cemployee/record/detail',
    });
});

Espo.define('custom:views/cemployee/detail', 'views/detail', function (Dep) {
    return Dep.extend({
        setup: function () {
            Dep.prototype.setup.call(this);
            
            // Add Clock In button
            this.addMenuItem('buttons', {
                name: 'clockIn',
                label: 'Clock In',
                action: 'clockIn',
                style: 'success'
            });
            
            // Add Clock Out button
            this.addMenuItem('buttons', {
                name: 'clockOut',
                label: 'Clock Out',
                action: 'clockOut',
                style: 'danger'
            });
            
            // Add View Attendance History button
            this.addMenuItem('buttons', {
                name: 'attendanceHistory',
                label: 'My Attendance History',
                action: 'attendanceHistory',
                style: 'default'
            });
        },
        
        actionClockIn: function () {
            Espo.Ui.notify('Processing...');
            
            this.ajaxPostRequest('CEmployee/action/clockIn', {})
                .then(function (response) {
                    Espo.Ui.success(response.message);
                    
                    // Show success dialog
                    this.createView('dialog', 'views/modal', {
                        templateContent: '<div class="record">' +
                            '<p><strong>Clocked In At:</strong> ' + response.time + '</p>' +
                            '</div>',
                        headerText: 'Clock In Successful'
                    }, function (view) {
                        view.render();
                    });
                }.bind(this))
                .fail(function (xhr) {
                    var response = xhr.getResponseHeader('X-Status-Reason') || 'Error occurred';
                    Espo.Ui.error(response);
                    
                    this.createView('dialog', 'views/modal', {
                        templateContent: '<div class="record text-danger">' +
                            '<p>' + response + '</p>' +
                            '</div>',
                        headerText: 'Clock In Failed'
                    }, function (view) {
                        view.render();
                    });
                }.bind(this));
        },
        
        actionClockOut: function () {
            Espo.Ui.notify('Processing...');
            
            this.ajaxPostRequest('CEmployee/action/clockOut', {})
                .then(function (response) {
                    Espo.Ui.success(response.message);
                    
                    // Show success dialog
                    this.createView('dialog', 'views/modal', {
                        templateContent: '<div class="record">' +
                            '<p><strong>Clocked Out At:</strong> ' + response.time + '</p>' +
                            '<p><strong>Total Hours:</strong> ' + response.totalHours + ' hours</p>' +
                            '</div>',
                        headerText: 'Clock Out Successful'
                    }, function (view) {
                        view.render();
                    });
                }.bind(this))
                .fail(function (xhr) {
                    var response = xhr.getResponseHeader('X-Status-Reason') || 'Error occurred';
                    Espo.Ui.error(response);
                    
                    this.createView('dialog', 'views/modal', {
                        templateContent: '<div class="record text-danger">' +
                            '<p>' + response + '</p>' +
                            '</div>',
                        headerText: 'Clock Out Failed'
                    }, function (view) {
                        view.render();
                    });
                }.bind(this));
        },
        
        actionAttendanceHistory: function () {
            this.ajaxGetRequest('CEmployee/action/attendanceHistory', {})
                .then(function (history) {
                    this.createView('dialog', 'views/modal', {
                        templateContent: this.prepareHistoryTemplate(history),
                        headerText: 'My Attendance History',
                        width: '800px'
                    }, function (view) {
                        view.render();
                    });
                }.bind(this));
        },
        
        prepareHistoryTemplate: function (history) {
            if (!history || history.length === 0) {
                return '<div class="text-center text-muted">No attendance records found</div>';
            }
            
            let html = '<table class="table table-bordered">' +
                '<thead>' +
                '<tr>' +
                '<th>Date</th>' +
                '<th>First Clock In</th>' +
                '<th>Last Clock Out</th>' +
                '<th>Total Hours</th>' +
                '<th>Status</th>' +
                '<th>Actions</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';
                
            history.forEach(function (record) {
                html += '<tr>' +
                    '<td>' + record.date + '</td>' +
                    '<td>' + (record.firstClockIn || '-') + '</td>' +
                    '<td>' + (record.lastClockOut || 'Not Clocked Out') + '</td>' +
                    '<td>' + (record.totalHours ? record.totalHours + ' h' : '-') + '</td>' +
                    '<td>' + (record.status || '-') + '</td>' +
                    '<td><button class="btn btn-sm btn-info" onclick="alert(\'View details for ' + record.id + '\')">Details</button></td>' +
                    '</tr>';
            });
            
            html += '</tbody></table>';
            return html;
        }
    });
});