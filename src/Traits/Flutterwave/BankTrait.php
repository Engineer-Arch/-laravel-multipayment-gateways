<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

trait BankTrait
{
    const BANK_ENDPOINT = '/banks/';

    /**
     * Get list of banks for a given country by shortcode.
     *
     * @param  string  $countryCode
     *
     * @return array
     */
    public function getBanks(string $countryCode): array
    {
        $endpoint = $this->baseUri.self::BANK_ENDPOINT.$countryCode;

        $banks = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            isJsonRequest: true
        );

        // sort banks by name
        array_multisort(array_column($banks['data'], 'name'), SORT_ASC, $banks['data']);

        return $banks;
    }

    /**
     * Get all branches of a bank
     *
     * @param  int  $bankId The ID of the bank for which to retrieve branches
     *
     * @return array
     */
    public function getBankBranches(int $bankId): array
    {
        $endpoint = $this->baseUri.self::BANK_ENDPOINT.$bankId.'/branches';

        $branches = $this->makeRequest(
            method: 'GET',
            requestUrl: $endpoint,
            isJsonRequest: true
        );

        return $branches;
    }
}
