var PaymentCalculator = (function () {
    var outMonthlyPayment = {};
    var outBiWeeklyPayment = {};

    var modalCalculateBtn = {};
    var calculatePaymentLinkBtn = {};

    var calculateFn = {};
    var isValidInputFn = {};
    var isValid_Trade_DownPayment_Fn = {};
    var onlyNumberAndDigitsAllowedFn = {};

    return {
        init: function () {
            outMonthlyPayment = $('.modal-monthly-payment');
            outBiWeeklyPayment = $('.modal-bi-weekly');
            modalCalculateBtn = $('.modal-calculate-btn');
            calculatePaymentLinkBtn = $('.calculate-payment-link');
            calculateFn = null;
            isValidInputFn = null;
            isValid_Trade_DownPayment_Fn = null;

            this.bindPaymentCalculatorActions();
        },

        bindPaymentCalculatorActions: function () {
            calculatePaymentLinkBtn.click(function (event) {
                var dataCarPrice = $(this).attr('data-price');
                var noCommaCarPrice = dataCarPrice.replace(/,/g, "");
                var paymentModalId = $(this).attr('data-target');
                var modal = $(paymentModalId);
                var modalBody = modal.find('.modal-body');
                modalBody.find('.modal-car-price').val(noCommaCarPrice);

                modalCalculateBtn.click(function (e) {
                    var carPrice = {
                        elem: modalBody.find('.modal-car-price'),
                        val: modalBody.find('.modal-car-price').val()
                    }, downPayment = {
                        elem: modalBody.find('.modal-down-payment'),
                        val: modalBody.find('.modal-down-payment').val()
                    }, trade = {
                        elem: modalBody.find('.modal-trade'),
                        val: modalBody.find('.modal-trade').val()
                    }, termByMonths = {
                        elem: modalBody.find('.modal-term'),
                        val: modalBody.find('.modal-term').val()
                    }, interestRate = {
                        elem: modalBody.find('.modal-int-rate'),
                        val: modalBody.find('.modal-int-rate').val()
                    }, salesTax = {
                        elem: modalBody.find('.modal-sales-tax'),
                        val: modalBody.find('.modal-sales-tax').val()
                    };

                    onlyNumberAndDigitsAllowedFn([carPrice, trade, downPayment, termByMonths, interestRate, salesTax]);

                    var inputs = {
                        _carPrice: parseFloat(carPrice.val),
                        _downPayment: parseFloat(downPayment.val),
                        _trade: parseFloat(trade.val),
                        _termByMonths: parseInt(termByMonths.val),
                        _interestRate: parseFloat(interestRate.val),
                        _salesTax: parseFloat(salesTax.val)
                    };

                    if (isValidInputFn(downPayment.val)) {
                        inputs._downPayment = 0;
                    }
                    if (isValidInputFn(trade.val)) {
                        inputs._trade = 0;
                    }
                    if (isValidInputFn(interestRate.val)) {
                        inputs._interestRate = 0;
                    }
                    if (isValidInputFn(salesTax.val)) {
                        inputs._salesTax = 0;
                    }

                    isValid_Trade_DownPayment_Fn(inputs);

                    // finally calculate the payment here
                    var _payment = calculateFn(inputs);
                    var monthlyPayment = _payment.toFixed(2);
                    var biWeeklyPayment = (_payment / 2).toFixed(2);

                    outMonthlyPayment.empty();
                    outMonthlyPayment.append(monthlyPayment);
                    outBiWeeklyPayment.empty();
                    outBiWeeklyPayment.append(biWeeklyPayment);

                    e.preventDefault();
                });
                event.preventDefault();
            });
            /**
             * loan amortization formula
             * A = the monthly payment.
             * P = the principal
             * r = the interest rate per month, which equals the annual interest rate divided by 12
             * n = the total number of months
             * adjustRate = r/12
             * numerator = (r (1 + r) ^ n)
             * denominator = (((1 + r)^n) - 1)
             * payment = P * (numerator / denominator)
             * deduct: down payment, trade in value if any
             * augment: sales tax if any
             * @param options
             */
            calculateFn = function (options) {
                const MONTHLY = 12;
                var monthlyInterest = (options._interestRate / MONTHLY);
                var monthlyInterestRate = (monthlyInterest / 100);
                var numerator = monthlyInterestRate * Math.pow((1 + monthlyInterestRate), options._termByMonths);
                var denominator = Math.pow((1 + monthlyInterestRate), options._termByMonths) - 1;

                var principal = options._carPrice;
                if (!isValidInputFn(options._salesTax)) {
                    principal += principal * (options._salesTax / 100);
                }
                if (!isValidInputFn(options._trade)) {
                    // deduct trade in
                    principal -= options._trade;
                }
                if (!isValidInputFn(options._downPayment)) {
                    // deduct down payment
                    principal -= options._downPayment;
                }
                return principal * (numerator / denominator);
            };
            /**
             * Validation for non-numeric input.
             * Only allowed inputs: 123, 12., 12.232
             * @param fields
             */
            onlyNumberAndDigitsAllowedFn = function (fields) {
                var pattern = /^\d*\.?\d*$/;
                for (var i = 0; i < fields.length; i++) {
                    if (fields[4].val.length === 0 || fields[4].val === 0) { // for interest rate
                        fields[4].elem.parent().parent().find('td').last().empty();
                        fields[4].elem.parent().parent().find('td').last().append("<label>&nbsp;Please enter a number.</label>");
                    }
                    if (!pattern.test(fields[i].val)) {
                        fields[i].elem.parent().parent().find('td').last().empty();
                        fields[i].elem.parent().parent().find('td').last().append("<label>&nbsp;Invalid input.</label>");
                        break;
                    } else {
                        fields[i].elem.parent().parent().find('td').last().empty();
                    }
                }
            };
            /**
             * Returns true if the input is invalid
             * Invalid if null, undefined, or empty string
             * @param input
             * @returns {boolean}
             */
            isValidInputFn = function (input) {
                return input === null || input === undefined || input === "";
            };
            isValid_Trade_DownPayment_Fn = function (input) {
                if (input._downPayment > input._carPrice) {
                    alert('Down payment cannot be greater than car price.');
                } else if (input._trade > input._carPrice) {
                    alert('Trade cannot be greater than car price.');
                }
            }
        }
    }; // end return
})();

var VehicleReferral = (function () {
    var referralModalForm_Sel = null;
    var validEmailFormat_Fn = function (input) {
        return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(input);
    };
    var referralRequest = function (params) {
        $.ajax({
            url: 'mailer/referral.php',
            type: 'post',
            data: params
        }).done(function (response) {
            if (response === '1') {
                console.log(response);
            }
        });
    };
    var referralModalForm_Fn = function () {
        referralModalForm_Sel.find('input[type=submit]').click(function () {
            var friendEmails = referralModalForm_Sel.find('input[type=text]#receiverEmail').val();
            var emailArray = friendEmails.split(",");
            var canProceed = true;
            for (var i = 0; i < emailArray.length; i++) {
                if (!validEmailFormat_Fn(emailArray[i].trim())) {
                    alert("You have entered an invalid email address!");
                    canProceed = false;
                }
            }
            if (canProceed === true) {
                alert('hello there');
                referralRequest(referralModalForm_Sel.serializeArray())
            }
            return false;
        });
    };
    var mainActions = function () {
        referralModalForm_Fn();
    };
    return {
        init: function () {
            referralModalForm_Sel = $('#referral-modal-form');
            mainActions();
        }
    };
})();