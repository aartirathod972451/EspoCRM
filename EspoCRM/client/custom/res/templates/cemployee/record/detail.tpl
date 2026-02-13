<div class="detail" id="{{id}}" data-scope="{{scope}}" tabindex="-1">

    {{! --- BUTTONS (Fixed: No duplicate code, proper nesting) --- }}
    {{#unless buttonsDisabled}}
    <div class="detail-button-container button-container record-buttons">
        <div class="sub-container clearfix">
            <div class="btn-group actions-btn-group" role="group">
                {{#each buttonList}}
                {{button name scope=../entityType label=label labelTranslation=labelTranslation style=style
                hidden=hidden html=html title=title text=text className='btn-xs-wide detail-action-item'
                disabled=disabled}}
                {{/each}}
                {{#if dropdownItemList}}
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span
                        class="fas fa-ellipsis-h"></span></button>
                <ul class="dropdown-menu pull-left">
                    {{#each dropdownItemList}}
                    {{#if this}}{{dropdownItem name scope=../entityType label=label labelTranslation=labelTranslation
                    html=html title=title text=text hidden=hidden disabled=disabled data=data
                    className='detail-action-item'}}{{else}}<li class="divider"></li>{{/if}}
                    {{/each}}
                </ul>
                {{/if}}
            </div>
            {{#if navigateButtonsEnabled}}
            <div class="pull-right">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-text btn-icon action" data-action="previous"
                        title="{{translate 'Previous'}}" {{#unless previousButtonEnabled}}disabled{{/unless}}><span
                            class="fas fa-chevron-left"></span></button>
                    <button type="button" class="btn btn-text btn-icon action" data-action="next"
                        title="{{translate 'Next'}}" {{#unless nextButtonEnabled}}disabled{{/unless}}><span
                            class="fas fa-chevron-right"></span></button>
                </div>
            </div>
            {{/if}}
        </div>
    </div>

    {{! --- EDIT BUTTONS CONTAINER (Crucial for Save/Cancel visibility) --- }}
    <div class="detail-button-container button-container edit-buttons hidden">
        <div class="sub-container clearfix">
            <div class="btn-group actions-btn-group" role="group">
                {{#each buttonEditList}}
                {{button name scope=../entityType label=label labelTranslation=labelTranslation style=style
                hidden=hidden html=html title=title text=text className='btn-xs-wide edit-action-item'
                disabled=disabled}}
                {{/each}}
                {{#if dropdownEditItemList}}
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span
                        class="fas fa-ellipsis-h"></span></button>
                <ul class="dropdown-menu pull-left">
                    {{#each dropdownEditItemList}}
                    {{#if this}}{{dropdownItem name scope=../entityType label=label labelTranslation=labelTranslation
                    html=html title=title text=text hidden=hidden disabled=disabled data=data
                    className='edit-action-item'}}{{else}}<li class="divider"></li>{{/if}}
                    {{/each}}
                </ul>
                {{/if}}
            </div>
        </div>
    </div>
    {{/unless}}

    <style>
        .profile-header-card {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 25px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .avatar-img {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 4px solid #eee;
            object-fit: cover;
        }

        .employee-info h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .badge-current {
            background: #e0f2f1;
            color: #00897b;
            font-size: 11px;
            padding: 3px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .header-meta {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #555;
            font-size: 13.5px;
        }

        .meta-item i {
            color: #0085ff;
            width: 18px;
            text-align: center;
        }

        /* CUSTOM DOC DESIGN */
        .doc-layout {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            display: flex;
            margin-top: 10px;
            overflow: hidden;
        }

        .doc-sidebar {
            width: 180px;
            border-right: 1px solid #eee;
            background: #fafafa;
            padding-top: 20px;
        }

        .side-link {
            padding: 12px 20px;
            font-size: 13px;
            color: #555;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .side-link.active {
            color: #0085ff;
            background: #f0f7ff;
            border-left: 4px solid #0085ff;
            font-weight: bold;
        }

        .doc-main {
            flex: 1;
            padding: 30px;
        }

        .sec-header {
            color: #0085ff;
            font-weight: 700;
            border-bottom: 1px solid #f1f1f1;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .doc-flex {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .doc-data {
            width: 70%;
        }

        .label-sm {
            color: #999;
            font-size: 11px;
            margin-top: 12px;
            text-transform: uppercase;
        }

        .val-md {
            color: #333;
            font-size: 14px;
            font-weight: 500;
        }

        /* IMAGE BOX */
        .img-wrapper {
            text-align: right;
            width: 100px;
        }

        .live-doc-frame {
            width: 100px;
            height: 130px;
            background: #fdfdfd;
            border: 1px solid #eee;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-top: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .live-doc-frame img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
    </style>

    <div class="record-grid">
        <div class="left">

            {{! --- IMPROVED PROFILE HEADER WITH ASSIGNED USER --- }}
            <div class="profile-header-card">
                <div class="header-left">
                    {{#if model.attributes.profileId}}
                    <img class="avatar-img" src="?entryPoint=image&id={{model.attributes.profileId}}&size=medium">
                    {{else}}
                    <div class="avatar-img"
                        style="background:#f0f0f0; display:flex; align-items:center; justify-content:center;"><i
                            class="fas fa-user fa-4x" style="color:#ccc"></i></div>
                    {{/if}}
                    <div class="employee-info">
                        <h2>{{model.attributes.name}} <span class="badge-current">Current employee</span></h2>
                        <div class="header-meta">
                            {{#if model.attributes.workRoleName}}
                            <div class="meta-item"><i class="fas fa-laptop-code"></i> <b>Role:</b>
                                {{model.attributes.workRoleName}}</div>
                            {{/if}}

                            {{#if model.attributes.departmentName}}
                            <div class="meta-item"><i class="fas fa-sitemap"></i> <b>Dept:</b>
                                {{model.attributes.departmentName}}</div>
                            {{/if}}

                            {{#if model.attributes.assignedUserName}}
                            <div class="meta-item"><i class="fas fa-user-check"></i> <b>Assigned To:</b>
                                {{model.attributes.assignedUserName}}</div>
                            {{/if}}
                        </div>
                    </div>
                </div>
            </div>
            {{! --- ALL EmployeeBank Details --- }}
            <div class="employee-details-container card shadow-sm border-0 mt-4">
                <div class="card-body p-4">
                    <h5 class="mb-3" style="color:#0085ff; font-weight:600;">
                        <i class="fas fa-university mr-2"></i>
                        Bank Accounts
                        <span class="badge badge-light">{{model.attributes.employeeBanksCount}}</span>
                    </h5>

                    {{#if model.attributes.employeeBanksData.length}}
                    <div class="bank-accounts-list">
                        {{#each model.attributes.employeeBanksData}}
                        <div class="bank-account-item card mb-3 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-building text-primary mr-2"></i>
                                            <h6 class="mb-0 font-weight-bold">{{bankName}}</h6>
                                        </div>
                                        <div class="pl-4">
                                            <div class="mb-2">
                                                <span class="text-muted small">Branch:</span>
                                                <span class="ml-2">{{branchName}}</span>
                                            </div>
                                            <div class="mb-2">
                                                <span class="text-muted small">Account Holder:</span>
                                                <span class="ml-2 font-weight-medium">{{accountHolderName}}</span>
                                            </div>
                                            <div class="mb-2">
                                                <span class="text-muted small">Account Type:</span>
                                                <span class="ml-2 badge badge-info">{{accountType}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="bank-details-right">
                                            <div class="mb-2">
                                                <span class="text-muted small">Account No:</span>
                                                <span class="ml-2 font-monospace">{{accountNo}}</span>
                                            </div>
                                            <div class="mb-2">
                                                <span class="text-muted small">IFSC Code:</span>
                                                <span class="ml-2 font-monospace">{{ifscCode}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{/each}}
                    </div>
                    {{else}}
                    <div class="alert alert-light text-center py-4">
                        <i class="fas fa-university fa-2x text-muted mb-2"></i>
                        <p class="mb-0 text-muted">No bank accounts found for this employee.</p>
                    </div>
                    {{/if}}
                </div>
            </div>







            {{! --- CUSTOM DOC BOX WITH REAL AADHAAR IMAGE --- }}

            {{! --- SYSTEM FIELD LAYOUT (MIDDLE) --- }}
            {{! To make the Custom section EDITABLE: When you click Edit, these fields appear below }}
            <div class="middle" style="margin-top:30px;">{{{middle}}}</div>
        </div>

        <div class="side">{{{side}}}</div>
    </div>
</div>

<div class="detail" id="{{id}}" data-scope="{{scope}}" tabindex="-1">

    {{! --- BUTTONS (Fixed: No duplicate code, proper nesting) --- }}
    {{#unless buttonsDisabled}}
    <div class="detail-button-container button-container record-buttons">
        <div class="sub-container clearfix">
            <div class="btn-group actions-btn-group" role="group">
                {{#each buttonList}}
                {{button name scope=../entityType label=label labelTranslation=labelTranslation style=style
                hidden=hidden html=html title=title text=text className='btn-xs-wide detail-action-item'
                disabled=disabled}}
                {{/each}}
                {{#if dropdownItemList}}
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span
                        class="fas fa-ellipsis-h"></span></button>
                <ul class="dropdown-menu pull-left">
                    {{#each dropdownItemList}}
                    {{#if this}}{{dropdownItem name scope=../entityType label=label labelTranslation=labelTranslation
                    html=html title=title text=text hidden=hidden disabled=disabled data=data
                    className='detail-action-item'}}{{else}}<li class="divider"></li>{{/if}}
                    {{/each}}
                </ul>
                {{/if}}
            </div>
            {{#if navigateButtonsEnabled}}
            <div class="pull-right">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-text btn-icon action" data-action="previous"
                        title="{{translate 'Previous'}}" {{#unless previousButtonEnabled}}disabled{{/unless}}><span
                            class="fas fa-chevron-left"></span></button>
                    <button type="button" class="btn btn-text btn-icon action" data-action="next"
                        title="{{translate 'Next'}}" {{#unless nextButtonEnabled}}disabled{{/unless}}><span
                            class="fas fa-chevron-right"></span></button>
                </div>
            </div>
            {{/if}}
        </div>
    </div>

    {{! --- EDIT BUTTONS CONTAINER (Crucial for Save/Cancel visibility) --- }}
    <div class="detail-button-container button-container edit-buttons hidden">
        <div class="sub-container clearfix">
            <div class="btn-group actions-btn-group" role="group">
                {{#each buttonEditList}}
                {{button name scope=../entityType label=label labelTranslation=labelTranslation style=style
                hidden=hidden html=html title=title text=text className='btn-xs-wide edit-action-item'
                disabled=disabled}}
                {{/each}}
                {{#if dropdownEditItemList}}
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span
                        class="fas fa-ellipsis-h"></span></button>
                <ul class="dropdown-menu pull-left">
                    {{#each dropdownEditItemList}}
                    {{#if this}}{{dropdownItem name scope=../entityType label=label labelTranslation=labelTranslation
                    html=html title=title text=text hidden=hidden disabled=disabled data=data
                    className='edit-action-item'}}{{else}}<li class="divider"></li>{{/if}}
                    {{/each}}
                </ul>
                {{/if}}
            </div>
        </div>
    </div>
    {{/unless}}


</div>



<script>
    $(document).ready(function () {
        // Auto-refresh every 2 seconds until banks load
        const checkBanks = setInterval(() => {
            if (window.employeeView && window.employeeView.model
                && window.employeeView.model.links
                && window.employeeView.model.links.employeeBanks
                && window.employeeView.model.links.employeeBanks.models
                && window.employeeView.model.links.employeeBanks.models.length) {
                window.employeeView.reRender();
                clearInterval(checkBanks);
            }
        }, 2000);
    });
</script>