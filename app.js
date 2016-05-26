(function(){
	var app = angular.module('funwithcountries', ['ngRoute']);

	//Service Setup
	app.factory('countryService', function($http) {
		var baseUrl = 'services/';
		return {
			getCountries: function() {
				return $http.get(baseUrl + 'getCountries.php');
			},
			getStates: function(countryCode) {
				return $http.get(baseUrl + 'getStates.php?countryCode=' + encodeURIComponent(countryCode));
			}
		};
	});

	app.controller('CountryController', function(countryService){

		var that = this;

		//Service consumption
		countryService.getCountries()
			.success(function(data) {
				that.countries = data;
			});

		/*this.countries = [
			{
				name: 'Germany',
				code: 'DE',
				states: [{name: 'Bavaria'}, {name: 'Berlin'}]
			},
			{
				name: 'United States',
				code: 'US',
				states: [{name: 'California'}, {name: 'Maryland'}]
			},
			{
				name: 'Luxembourg',
				code: 'LU'
			}
		];*/
	});

	//configuracion de rutas
	app.config(function($routeProvider) {
		$routeProvider.when('/states/:countryCode', {
			templateUrl: 'state-view.html',
			controller: function($routeParams, countryService) {
				this.params = $routeParams;

				var that = this;

				countryService.getStates(this.params.countryCode || '').success(function(data) {
					that.states = data;
				});

				this.addStateTo = function() {
					if (this.newState !== '' && typeof(this.newState) !== 'undefined') {
						if (!this.states) {
							this.states = [];
						}
						this.states.push({name: this.newState});
						this.newState = '';
					}
				};
			},
			controllerAs: 'stateCtrl'
		});
	});

/*	app.directive('stateView', function() {
		return {
			restrict: 'E',
			templateUrl: 'state-view.html',
			controller: function() {
				this.addStateTo = function(country) {
					if (this.newState !== '' && typeof(this.newState) !== 'undefined') {
						if (!country.states) {
							country.states = [];
						}
						country.states.push({name: this.newState});
						this.newState = '';
					}
				};
			},
			controllerAs: 'stateCtrl'
		};
	});*/

})();