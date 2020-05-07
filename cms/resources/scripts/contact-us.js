apiUrl = window.location.origin + '/api/';
$(document).ready(function() {
    // get emails
    $.get(apiUrl + 'contact', insertEmails, 'json');
});

/**
 * Create page elements for each email
 */
function insertEmails(emails) {
    const container = $('#contact_us_group');
    emails.forEach(email => {
        container.append(`
            <div class="card" id="email_${email['id']}">
                <div class="card-header" id="heading${email['id']}">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse${email['id']}" aria-expanded="false" aria-controls="collapse${email['id']}">
                    ${email['subject']} - ${email['name']}
                    </button>
                </h5>
                </div>
            
                <div id="collapse${email['id']}" class="collapse" aria-labelledby="heading${email['id']}" data-parent="#contact_us_group" style="">
                <div class="card-body">
                    <div class="container>
                        <div class=" row"="">
                        ${email['message']}
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <a href="mailto:${email['email']}?Subject=B%26D%20Deli%20Inquiry" target="_top" class="btn btn-primary">Send Email</a>
                            </div>
                            <div class="col-sm-">
                                <button class="btn btn-danger" onclick="deleteEmail(${email['id']});">Delete Message</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);
    });
}

/**
 * Delete an email for the given id
 */
function deleteEmail(id) {
    $.ajax({
        url: apiUrl + 'contact?id=' + id,
        type: 'DELETE',
        success: () => {
            $('#email_' + id).remove();
        }
    });
}