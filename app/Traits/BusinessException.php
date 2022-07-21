<?php

namespace App\Traits;

use App\Helpers\CommonUtil;
use App\Helpers\Constants;
use App\Helpers\DateTimeConverter;
use Exception;
use Throwable;
use Illuminate\Support\Facades\Log;

class BusinessException extends Exception
{
    /**
     * @var
     */
    public $message;
    protected $httpStatus;
    protected $code;
    /**
     * @var string|null
     */
    private $request_id;

    /**
     * GeneralException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(int $httpStatus, $message = Constants::ERROR_MESSAGE_404, $code = Constants::HTTP_CODE_404, string $request_id = null, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->httpStatus = $httpStatus;
        $this->code = $code;
        $this->message = $message;
        $this->request_id = $request_id;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request
     * @return \never
     */
    public function render()
    {
        return abort(response()->json([
            'request_id' => $this->request_id === null ? CommonUtil::generateUUID() : $this->request_id,
            "code" => $this->code,
            "status" => 'error',
            "message" => $this->message,
            "time_stamp" => DateTimeConverter::getDateTimeNow()
        ], $this->httpStatus));
    }
}
