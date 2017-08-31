var PaymentCalculator = (function () {
    var outMonthlyPayment = {};
    var outBiWeeklyPayment = {};

    var modalCalculateBtn = {};
    var calculatePaymentLinkBtn = {};

    var calculateFn = {};
    var isValidInputFn = {};
    var onlyNumberAndDigitsAllowedFn = {};

    return {

        /**
         * All the elements required before an
         * event occurred must be in the init function.
         */
        init: function () {

            outMonthlyPayment = null;
            outBiWeeklyPayment = null;

            modalCalculateBtn = $('.modal-calculate-btn');
            calculatePaymentLinkBtn = $('.calculate-payment-link');

            calculateFn = null;
            isValidInputFn = null;

            this.bindPaymentCalculatorActions();
        },

        bindPaymentCalculatorActions: function () {

            calculatePaymentLinkBtn.click(function (event) {
                var dataCarPrice = $(this).attr('data-price');
                var paymentModalId = $(this).attr('data-target');

                var modal = $(paymentModalId);
                var modalBody = modal.find('.modal-body');
                modalBody.find('.modal-car-price').val(dataCarPrice);

                modalCalculateBtn.click(function (e) {
                    var carPrice = {
                        elem : modalBody.find('.modal-car-price'),
                        val: modalBody.find('.modal-car-price').val()
                    };
                    var downPayment = {
                        elem: modalBody.find('.modal-down-payment'),
                        val: modalBody.find('.modal-down-payment').val()
                    };
                    var trade = {
                        elem:  modalBody.find('.modal-trade'),
                        val:  modalBody.find('.modal-trade').val()
                    };
                    var termByMonths = {
                        elem: modalBody.find('.modal-term'),
                        val: modalBody.find('.modal-term').val()
                    };
                    var interestRate = {
                        elem: modalBody.find('.modal-int-rate'),
                        val: modalBody.find('.modal-int-rate').val()
                    };
                    var salesTax = {
                        elem: modalBody.find('.modal-sales-tax'),
                        val: modalBody.find('.modal-sales-tax').val()
                    };

                    onlyNumberAndDigitsAllowedFn([
                        carPrice, downPayment, trade, termByMonths, interestRate, salesTax
                    ]);

                    var h =  "car price=" + carPrice.val + ": downPayment=" + downPayment.val + ": trade=" + trade.val + " : terms=" + termByMonths.val;
                    h += " : interest rate=" + interestRate.val + " : sales tax="+ salesTax.val;
                    console.log(h);

                    var inputs = {
                        _carPrice: parseFloat(carPrice.val),
                        _downPayment: parseFloat(downPayment.val),
                        _trade: parseFloat(trade.val),
                        _termByMonths: parseInt(termByMonths.val),
                        _interestRate: parseFloat(interestRate.val),
                        _salesTax: parseFloat(salesTax.val)
                    };
                    if(isValidInputFn(downPayment.val)) {
                        inputs._downPayment = 0;
                    }
                    if(isValidInputFn(trade.val)) {
                        inputs._trade = 0;
                    }
                    if(isValidInputFn(interestRate.val)) {
                        inputs._interestRate = 0;
                    }
                    if(isValidInputFn(salesTax.val)) {
                        inputs._salesTax = 0;
                    }

                    console.log(inputs);



                    // finally calculate the payment here
                    calculateFn(inputs);

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
                var monthlyInterestRate = monthlyInterest / 100;

                console.log(options);
            };










            
            /**
             * Validation for non-numeric input.
             * Only allowed inputs: 123, 12., 12.232
             * @param fields
             */
            onlyNumberAndDigitsAllowedFn = function (fields) {
                /**
                 * ^ - Beginning of the line;
                 * \d* - 0 or more digits;
                 * \.? - An optional dot (escaped, because in regex, . is a special character);
                 * \d* - 0 or more digits (the decimal part);
                 * $ - End of the line.
                 */
                var pattern = /^\d*\.?\d*$/;
                for(var i = 0; i < fields.length; i++) {
                    if(!pattern.test(fields[i].val)) {
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
        }
    }; // end return
})();