define('custom:views/cattendance/record/list', ['views/record/list'], function (Dep) {

    return Dep.extend({
        
        setup: function () {
            Dep.prototype.setup.call(this);
            
            console.log('✓ Attendance list view loaded');
            
            // Add action handlers for buttons
            this.addActionHandler('clockIn', this.actionClockIn.bind(this));
            this.addActionHandler('clockOut', this.actionClockOut.bind(this));
        },
        
        afterRender: function () {
            Dep.prototype.afterRender.call(this);
            this.adjustButtonVisibility();
        },
        
        actionClockIn: function () {
            console.log('▶ Clock In clicked');
            Espo.Ui.notify('Processing...');
            
            Espo.Ajax.postRequest('CAttendance/action/clockIn', {})
                .then(function (response) {
                    if (response.status === 'success') {
                        // Show success popup
                        this.showSuccessPopup('Clock In Successful', response);
                    } else {
                        // Show error popup
                        this.showErrorPopup('Clock In Failed', response.message);
                    }
                    
                    if (this.collection) {
                        this.collection.fetch();
                    }
                    this.adjustButtonVisibility();
                }.bind(this))
                .fail(function (xhr) {
                    var msg = xhr.getResponseHeader('X-Status-Reason') || 'Clock In failed';
                    this.showErrorPopup('Clock In Failed', msg);
                }.bind(this));
        },
        
        actionClockOut: function () {
            console.log('◀ Clock Out clicked');
            Espo.Ui.notify('Processing...');
            
            Espo.Ajax.postRequest('CAttendance/action/clockOut', {})
                .then(function (response) {
                    if (response.status === 'success') {
                        // Show success popup
                        this.showSuccessPopup('Clock Out Successful', response);
                    } else {
                        // Show error popup
                        this.showErrorPopup('Clock Out Failed', response.message);
                    }
                    
                    if (this.collection) {
                        this.collection.fetch();
                    }
                    this.adjustButtonVisibility();
                }.bind(this))
                .fail(function (xhr) {
                    var msg = xhr.getResponseHeader('X-Status-Reason') || 'Clock Out failed';
                    this.showErrorPopup('Clock Out Failed', msg);
                }.bind(this));
        },
        
        showSuccessPopup: function (title, data) {
            var message = '';
            var icon = 'fa-check-circle';
            var color = '#28a745';
            
            if (title.includes('Clock In')) {
                if (data.clockInCount && data.clockInCount > 1) {
                    message = `
                        <div style="text-align: center; padding: 20px;">
                            <span class="fas fa-clock fa-4x" style="color: ${color};"></span>
                            <h3 style="color: ${color}; margin-top: 15px;">${title}</h3>
                            <p style="font-size: 18px; margin: 10px 0;"><strong>${data.message}</strong></p>
                            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-top: 15px;">
                                <p><strong>Time:</strong> ${data.time}</p>
                                <p><strong>Date:</strong> ${data.date}</p>
                                <p><strong>Clock Ins Today:</strong> ${data.clockInCount}</p>
                            </div>
                        </div>
                    `;
                } else {
                    message = `
                        <div style="text-align: center; padding: 20px;">
                            <span class="fas fa-check-circle fa-4x" style="color: ${color};"></span>
                            <h3 style="color: ${color}; margin-top: 15px;">${title}</h3>
                            <p style="font-size: 18px; margin: 10px 0;"><strong>${data.message}</strong></p>
                            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-top: 15px;">
                                <p><strong>Time:</strong> ${data.time}</p>
                                <p><strong>Date:</strong> ${data.date}</p>
                                <p><strong>First Clock In Today</strong></p>
                            </div>
                        </div>
                    `;
                }
            } else if (title.includes('Clock Out')) {
                message = `
                    <div style="text-align: center; padding: 20px;">
                        <span class="fas fa-check-circle fa-4x" style="color: ${color};"></span>
                        <h3 style="color: ${color}; margin-top: 15px;">${title}</h3>
                        <p style="font-size: 18px; margin: 10px 0;"><strong>${data.message}</strong></p>
                        <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-top: 15px;">
                            <p><strong>Time:</strong> ${data.time}</p>
                            <p><strong>Total Hours:</strong> ${data.totalHours} hrs</p>
                            <p><strong>Clock Outs Today:</strong> ${data.clockOutCount}</p>
                        </div>
                    </div>
                `;
            }
            
            this.createView('dialog', 'views/modal', {
                templateContent: message,
                headerText: '<span class="fas ' + icon + '" style="color: ' + color + ';"></span> ' + title,
                backdrop: true,
                width: '450px',
                className: 'dialog-success'
            }, function (view) {
                view.render();
                setTimeout(function() { view.close(); }, 5000);
            }.bind(this));
        },
        
        showErrorPopup: function (title, message) {
            var color = '#dc3545';
            
            var content = `
                <div style="text-align: center; padding: 20px;">
                    <span class="fas fa-exclamation-triangle fa-4x" style="color: ${color};"></span>
                    <h3 style="color: ${color}; margin-top: 15px;">${title}</h3>
                    <p style="font-size: 16px; margin: 15px 0; color: #666;">${message}</p>
                    <hr style="margin: 20px 0;">
                    <p style="color: #999; font-size: 14px;">
                        <span class="fas fa-info-circle"></span> 
                        If you believe this is an error, please contact HR.
                    </p>
                </div>
            `;
            
            this.createView('dialog', 'views/modal', {
                templateContent: content,
                headerText: '<span class="fas fa-times-circle" style="color: ' + color + ';"></span> ' + title,
                backdrop: true,
                width: '450px',
                className: 'dialog-error'
            }, function (view) {
                view.render();
            }.bind(this));
        },
        
        adjustButtonVisibility: function () {
            var $clockInBtn = this.$el.find('button[name="clockIn"]');
            var $clockOutBtn = this.$el.find('button[name="clockOut"]');
            
            var user = this.getUser();
            
            // Admin: hide both buttons (admin cannot clock in/out)
            if (user.isAdmin()) {
                $clockInBtn.hide();
                $clockOutBtn.hide();
                return;
            }
            
            // Employees: check status
            Espo.Ajax.getRequest('CAttendance/action/todayStatus')
                .then(function (data) {
                    console.log('Status:', data);
                    
                    if (!data.isEmployee) {
                        // User is not an employee - hide both buttons
                        $clockInBtn.hide();
                        $clockOutBtn.hide();
                        
                        // Show a small indicator
                        this.$el.find('.list-header').append(
                            '<div class="alert alert-warning" style="margin-bottom: 10px;">' +
                            '<span class="fas fa-info-circle"></span> ' +
                            'You are not assigned as an Employee. Only employees can clock in/out.' +
                            '</div>'
                        );
                    } else {
                        // Employee - show/hide based on status
                        $clockInBtn.toggle(data.canClockIn);
                        $clockOutBtn.toggle(data.canClockOut);
                    }
                }.bind(this))
                .catch(function (error) {
                    console.error('Failed to fetch status:', error);
                    $clockInBtn.hide();
                    $clockOutBtn.hide();
                }.bind(this));
        }
    });
});