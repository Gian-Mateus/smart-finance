<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class OFXParser
{
    public $parsed = [];

    /* Array indexes */
    public $bank;

    public $fid;

    public $dateStartStatement;

    public $dateEndStatement;

    public $type; // CREDIT or DEBIT

    public $dateTransaction;

    public $amount;

    public $id;

    public $description;

    public $transactions = [];

    public function __construct()
    {
        //
    }

    public function parse($notParsedFile)
    {

        $bank = $this->parseBankData($notParsedFile);
        $transactions = $this->parseTransactions($notParsedFile);

        return [
            'bankInfo' => $bank,
            'transactions' => $transactions,
        ];

        // dd($data);
        // dd($notParsedFile);
        // echo "<pre>";
        // echo "</pre>";

    }

    public function parseBankData($notParsedFile)
    {
        foreach ($notParsedFile as $nf) {
            // Bank Name
            if (Str::contains($nf, '<ORG>')) {
                $this->bank = trim(Str::remove(['<ORG>', '</ORG>'], $nf));
            }

            // Bank FID
            if (Str::contains($nf, '<FID>')) {
                $this->fid = trim(Str::remove(['<FID>', '</FID>'], $nf));
            }

            // Date start statement
            if (Str::contains($nf, '<DTSTART>')) {
                $this->dateStartStatement = trim(Str::remove(['<DTSTART>', '</DTSTART>'], $nf));
            }

            // Date end statement
            if (Str::contains($nf, '<DTEND>')) {
                $this->dateEndStatement = trim(Str::remove(['<DTEND>', '</DTEND>'], $nf));
            }
        }

        return [
            'bank' => $this->bank,
            'fid' => $this->fid,
            'dateStartStatement' => $this->dateStartStatement,
            'dateEndStatement' => $this->dateEndStatement,
        ];
    }

    public function parseTransactions($notParsedFile)
    {
        $i = 0;
        foreach ($notParsedFile as $nf) {
            if (Str::contains($nf, '<DTPOSTED>')) {
                $this->dateTransaction = Carbon::parse(trim(Str::remove(['<DTPOSTED>', '</DTPOSTED>', '[-3:BRT]'], $nf)))->toDateString();
            }
            if (Str::contains($nf, '<FITID>')) {
                $this->id = trim(Str::remove(['<FITID>', '</FITID>'], $nf));
            }
            if (Str::contains($nf, '<MEMO>')) {
                $this->description = trim(Str::remove(['<MEMO>', '</MEMO>'], $nf));
            }
            if (Str::contains($nf, '<TRNTYPE>')) {
                $this->type = trim(Str::remove(['<TRNTYPE>', '</TRNTYPE>'], $nf));
            }
            if (Str::contains($nf, '<TRNAMT>')) {
                $this->amount = (float) trim(Str::remove(['<TRNAMT>', '</TRNAMT>'], $nf));
            }

            if (Str::contains($nf, '</STMTTRN>')) {

                $this->transactions[$i] = [
                    'id' => $this->id,
                    'type' => $this->type,
                    'amount' => $this->amount,
                    'description' => $this->description,
                    'date' => $this->dateTransaction,
                ];
                $i++;
            }

        }

        return $this->transactions;
    }
}
