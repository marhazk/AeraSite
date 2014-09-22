/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GQueryPasswd extends Rpc
/*    */ {
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 12 */     GQueryPasswdArg arg = (GQueryPasswdArg)argument;
/* 13 */     GQueryPasswdRes res = (GQueryPasswdRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 18 */     GQueryPasswdArg arg = (GQueryPasswdArg)argument;
/* 19 */     GQueryPasswdRes res = (GQueryPasswdRes)result;
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GQueryPasswd
 * JD-Core Version:    0.6.2
 */