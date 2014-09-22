/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ import org.apache.commons.logging.Log;
/*    */ import org.apache.commons.logging.LogFactory;
/*    */ 
/*    */ public final class ForbidUser extends Rpc
/*    */ {
/*    */   public int retcode;
/* 13 */   public GRoleForbid groleforbid = new GRoleForbid();
/*    */ 
/* 15 */   private static final Log log = LogFactory.getLog(ForbidUser.class);
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result) throws ProtocolException {
/* 18 */     ForbidUserArg arg = (ForbidUserArg)argument;
/* 19 */     ForbidUserRes res = (ForbidUserRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 24 */     ForbidUserArg arg = (ForbidUserArg)argument;
/* 25 */     ForbidUserRes res = (ForbidUserRes)result;
/*    */ 
/* 27 */     synchronized (this) {
/* 28 */       this.retcode = res.retcode;
/* 29 */       this.groleforbid = res.forbid;
/* 30 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 36 */     synchronized (this) {
/* 37 */       this.retcode = 4;
/* 38 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.ForbidUser
 * JD-Core Version:    0.6.2
 */