$(document).ready(function() {
    function members(id, rank) {
        $.ajax({
            url: '/api/v1/members/' + id + '/' + rank,
            method: 'GET',
            success: function(response) {
                showMembers(response.members);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function showMembers(members) {
        $('#members').empty();
        members.forEach(function(member) {
            var memberHtml = `
                <div class="cell small-6 medium-2 group-member">
                    <a href="/users/${member.id}/${member.username}">
                    <div class="user-avatar">
                        <img class="user-avatar-image" src="${member.avatar}">
                    </div>
                    </a>
                    <a href="/users/${member.id}/${member.username}">${member.username}</a>
                </div>`;
            $('#members').append(memberHtml);
        });
    }

    $('#ranks').on('change', function() {
        var rank = $(this).val();
        var id = $('meta[name="id"]').attr('content');
        members(id, rank);
    });

    var initialRank = $('#ranks').val(); // just making sure it actually loads a rank on loading page
    var id = $('meta[name="id"]').attr('content');
    members(id, initialRank);
});