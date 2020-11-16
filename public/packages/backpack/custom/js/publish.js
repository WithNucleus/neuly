/*
*
* Backpack Crud / Create
*
*/

jQuery(function($){

    'use strict';

    $('.btn-restore-slug').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('input[name="original_slug"]').val();
        $('input[name="entity_slug"]').val(value);
    });

    $('.btn-restore-name').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('input[name="original_name"]').val();
        $('input[name="entity_name"]').val(value);
    });

    $('.btn-restore-email').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('input[name="original_email"]').val();
        $('input[name="entity_email"]').val(value);
    });

    $('.btn-restore-secondary').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('input[name="original_secondary_email"]').val();
        $('input[name="entity_secondary_email"]').val(value);
    });

    $('.btn-restore-website').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('input[name="original_website"]').val();
        $('input[name="entity_website"]').val(value);
    });

    $('.btn-restore-registration').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('input[name="original_registration"]').val();
        $('input[name="entity_registration"]').val(value);
    });

    $('.btn-restore-linkedin').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('input[name="original_linkedin"]').val();
        $('input[name="entity_linkedin"]').val(value);
    });

    $('.btn-restore-facebook').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('input[name="original_facebook"]').val();
        $('input[name="entity_facebook"]').val(value);
    });

    $('.btn-restore-twitter').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('input[name="original_twitter"]').val();
        $('input[name="entity_twitter"]').val(value);
    });

    $('.btn-restore-founded-date').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('input[name="original_founded_date"]').val();
        $('input[name="entity_founded_date"]').val(value);
    });

    $('.btn-restore-valuation').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('input[name="original_valuation"]').val();
        $('input[name="entity_valuation"]').val(value);
    });

    $('.btn-restore-employees').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('input[name="original_number_of_employees"]').val();
        $('input[name="entity_number_of_employees"]').val(value);
    });

    $('.btn-restore-fundings').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('input[name="original_total_funding_amount"]').val();
        $('input[name="entity_total_funding_amount"]').val(value);
    });

    $('.btn-restore-last-funding').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('input[name="original_last_funding_date"]').val();
        $('input[name="entity_last_funding_date"]').val(value);
    });

    $('.btn-restore-start').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('input[name="original_start"]').val();
        $('input[name="entity_start"]').val(value);
    });

    $('.btn-restore-end').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('input[name="original_end"]').val();
        $('input[name="entity_end"]').val(value);
    });

    $('.btn-restore-ticker').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('input[name="original_ticker"]').val();
        $('input[name="entity_ticker"]').val(value);
    });

    $('.btn-restore-biography').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('textarea[name="original_bio"]').html();
        $('textarea[name="entity_bio"]').html(value);
    });

    $('.btn-restore-summary').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('textarea[name="original_summary"]').html();
        $('textarea[name="entity_summary"]').html(value);
    });

    $('.btn-restore-description').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('textarea[name="original_description"]').html();
        $('textarea[name="entity_description"]').html(value);
    });

    $('.btn-restore-ownership').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('select[name="original_ownership"] option:selected').val();

        $('select[name="entity_ownership"] option:selected').removeAttr('selected');
        $('select[name="entity_ownership"] option:contains('+value+')').prop('selected',true);
    });

    $('.btn-restore-type').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var value = $('select[name="original_type"] option:selected').val();

        $('select[name="entity_type"] option:selected').removeAttr('selected');
        $('select[name="entity_type"] option:contains('+value+')').prop('selected',true);
    });

    $('.btn-restore-focus').on('click', function(e) {
        e.preventDefault();
        $(this).blur();
        var values = $('select[name="original_focus[]"]').val();

        $('select[name="entity_focus[]"] option:selected').removeAttr('selected');
        $.each(values, function(i, value) {
            $('select[name="entity_focus[]"] option[value="' + value + '"]').attr("selected", true);
        });
    });

    $('.js-btn-restore').on('click', function(e) {
        e.preventDefault();

        let btn = $(this),
            targetName = btn.data('target');

        btn.blur();

        let value = $('[name="original_' + targetName + '"]').val();
        $('[name="entity_' + targetName + '"]').val(value);
    });

    $('.js-owner-type-radio').on('change', function() {
        let type = $(this).data('type'),
            selectCompany = $('.js-owner-id-company'),
            selectInvestor = $('.js-owner-id-investor');

        if (type === 'company') {
            selectInvestor.attr('disabled', true).hide();
            selectCompany.attr('disabled', false).show();
        } else {
            selectCompany.attr('disabled', true).hide();
            selectInvestor.attr('disabled', false).show();
        }
    });

    $('.js-btn-restore-job-owner').on('click', function(e) {
        e.preventDefault();

        let btn = $(this);
        btn.blur();

        let ownerType = $('[name="original_owner_type"]').val(),
            ownerId = $('[name="original_owner_id"]').val();

        $('[name="entity_owner_type"]').each(function (){
            if ($(this).val() === ownerType) {
                $(this).trigger('click');
                $('[name="entity_owner_id"]:not(disabled)').val(ownerId);
            }
        });
    });
});

