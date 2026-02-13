define('custom:hello-handler', ['views/list'], function (Dep) {
    return Dep.extend({
        // ===== INITIALIZATION METHODS =====
        initShowHello: function () {
            // Button will call clockInList directly, no special init needed
        },

        // ===== CLOCK IN ACTION =====
        hello: function () {
            console.log('*** HELLO BUTTON CLICKED ***');
            alert('Hello from custom Emp Attendance List View!');
        },
        initShowRole: function () {
            // No init needed
        },

        showRole: function () {
    console.log('*** SHOW ROLE BUTTON CLICKED ***');
    
    // ✅ DIRECT API CALL - Bypasses ALL context issues
    Espo.Ajax.getRequest('App/user').then(function(response) {
        console.log('API Response:', response);
        
        var userName = response.user.name || 'Unknown';
        var rolesObj = response.rolesNames || {};
        var roleList = Object.keys(rolesObj).map(function(id) {
            return rolesObj[id];
        });
        
        alert('User: ' + userName + '\nRoles: ' + (roleList.join(', ') || 'None'));
    }).catch(function(xhr) {
        console.log('API Error:', xhr);
        alert('API Error - Check Console (F12)');
    });
}








    });
});
